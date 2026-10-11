<?php

namespace Drupal\tmwb_electronics_calculators\Plugin\Filter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Extension\ExtensionPathResolver;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Render\RendererInterface;
use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Embeds the Circuit Calculators from a placeholder in content.
 *
 * Editors add a plain placeholder where the tool should appear:
 *
 * @code
 * <div class="tmwb-electronics-calculators"></div>
 * @endcode
 *
 * Optional attribute: data-heading="h2" (heading level of the tool's
 * title, default h2).
 *
 * This filter runs at render time. It swaps the placeholder for the tool's
 * mount point plus a short server-rendered description (the tool itself is
 * built by JavaScript, so crawlers need real text), attaches the library
 * that loads the tool, and optionally adds WebApplication structured data
 * (JSON-LD) to the page head. The tool mounts on a fixed element id, so a
 * page can hold only one instance.
 *
 * @Filter(
 *   id = "tmwb_electronics_calculators_embed",
 *   title = @Translation("TMWB Electronics Calculators Embed"),
 *   description = @Translation("Replaces a div with the class tmwb-electronics-calculators with the Circuit Calculators tool."),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_TRANSFORM_IRREVERSIBLE,
 *   settings = {
 *     "show_description" = TRUE,
 *     "structured_data" = TRUE,
 *   },
 *   weight = 10
 * )
 */
class ElectronicsCalculatorsEmbedFilter extends FilterBase implements ContainerFactoryPluginInterface {

  /**
   * The renderer service.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * The request stack, used to build absolute URLs for the structured data.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;

  /**
   * The extension path resolver.
   *
   * @var \Drupal\Core\Extension\ExtensionPathResolver
   */
  protected $pathResolver;

  /**
   * Constructs the filter.
   *
   * @param array $configuration
   *   Plugin configuration.
   * @param string $plugin_id
   *   The plugin ID.
   * @param mixed $plugin_definition
   *   The plugin definition.
   * @param \Drupal\Core\Render\RendererInterface $renderer
   *   The renderer service.
   * @param \Symfony\Component\HttpFoundation\RequestStack $request_stack
   *   The request stack.
   * @param \Drupal\Core\Extension\ExtensionPathResolver $path_resolver
   *   The extension path resolver.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, RendererInterface $renderer, RequestStack $request_stack, ExtensionPathResolver $path_resolver) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->renderer = $renderer;
    $this->requestStack = $request_stack;
    $this->pathResolver = $path_resolver;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('renderer'),
      $container->get('request_stack'),
      $container->get('extension.path.resolver')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $form['show_description'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show a description under the tool'),
      '#default_value' => $this->settings['show_description'],
      '#description' => $this->t('A short, server-rendered list of what the tool can decode. Helps search engines and visitors without JavaScript.'),
    ];
    $form['structured_data'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Add structured data (JSON-LD)'),
      '#default_value' => $this->settings['structured_data'],
      '#description' => $this->t('Adds Schema.org WebApplication data to the page head so search engines understand what the tool is.'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    $result = new FilterProcessResult($text);

    if (strpos($text, 'tmwb-electronics-calculators') === FALSE) {
      return $result;
    }

    $dom = Html::load($text);
    $xpath = new \DOMXPath($dom);
    $nodes = $xpath->query('//div[contains(concat(" ", normalize-space(@class), " "), " tmwb-electronics-calculators ")]');

    if ($nodes->length === 0) {
      return $result;
    }

    // The tool mounts on a fixed element id, so only the first placeholder
    // on a page becomes the tool. Any further ones are removed instead of
    // producing duplicate ids.
    $replaced = FALSE;
    foreach ($nodes as $node) {
      if ($replaced) {
        $node->parentNode->removeChild($node);
        continue;
      }

      $heading = $node->getAttribute('data-heading');
      $render = [
        '#theme' => 'tmwb_electronics_calculators',
        '#heading' => preg_match('/^h[1-6]$/', $heading) ? $heading : 'h2',
        '#features' => static::features(),
        '#show_description' => !empty($this->settings['show_description']),
      ];
      $embed_html = (string) $this->renderer->renderInIsolation($render);

      // Parse the rendered markup into its own DOM, then import its nodes
      // in place of the placeholder.
      $embed_dom = Html::load($embed_html);
      $embed_body = $embed_dom->getElementsByTagName('body')->item(0);
      if ($embed_body) {
        foreach ($embed_body->childNodes as $child) {
          $node->parentNode->insertBefore($dom->importNode($child, TRUE), $node);
        }
      }
      $node->parentNode->removeChild($node);
      $replaced = TRUE;
    }

    $result->setProcessedText(Html::serialize($dom));
    $attachments = ['library' => ['tmwb_electronics_calculators/calculators']];
    if (!empty($this->settings['structured_data'])) {
      $attachments['html_head'] = [[$this->structuredData(), 'tmwb_electronics_calculators_jsonld']];
      // The structured data holds the page's own URL.
      $result->addCacheContexts(['url.path']);
    }
    $result->addAttachments($attachments);

    return $result;
  }

  /**
   * The parts the tool can decode, as label and description pairs.
   *
   * Used both for the visible description under the tool and for the
   * structured data, so crawlers and visitors see the same list.
   *
   * @return array
   *   Array of [label, description] pairs.
   */
  public static function features(): array {
    return [
      ['Ohm\'s law and power', 'Enter any two of voltage, current, resistance, and power. Shows the resistor wattage to use, the safety margin, and automatic engineering notation.'],
      ['LED resistor', 'Series or parallel LEDs, the nearest standard resistor value, the actual current, the resistor power, and a drawn circuit.'],
      ['Voltage divider', 'Finds E12, E24, E48, or E96 resistor pairs for a target output, with error, divider current, resistor power, loaded output, and output impedance.'],
      ['Series and parallel resistors', 'Any number of resistors, plus a search for the closest combination to a target value.'],
      ['Series and parallel capacitors', 'Any number of capacitors, plus a search for the closest combination to a target capacitance.'],
      ['RC filter', 'Time constant, cutoff frequency, and charge times, plus a designer that finds R or C for a target cutoff.'],
      ['LC resonance and reactance', 'Resonant frequency, reactance, and the Q and bandwidth of a resonant circuit.'],
      ['555 timer', 'Astable frequency and duty cycle, and monostable pulse length.'],
      ['LM317 regulator', 'Find the resistor for a target voltage, the voltage from the resistors, or the resistor for a constant-current source.'],
      ['Wire gauge and voltage drop', 'AWG size, resistance, voltage drop, and power lost over a run of copper wire.'],
      ['I2C pull-up resistors', 'The allowed pull-up range for 100 kHz, 400 kHz, and 1 MHz buses from the NXP I2C specification.'],
      ['Battery life', 'Run time from capacity and load, including sleep current and duty cycle.'],
      ['BJT switch', 'Base resistor for saturating an NPN transistor with a forced beta of 10.'],
      ['MOSFET switch', 'Conduction loss, voltage drop, and a gate resistor for a logic-level MOSFET.'],
      ['Op-amp gain', 'Inverting, non-inverting, summing, and difference stages, with the resistors for a target gain.'],
      ['Zener regulator', 'Series resistor and power ratings for a simple zener regulator.'],
      ['Divider tolerance', 'The worst-case output of a voltage divider for a given resistor tolerance.'],
      ['Current shunt', 'Shunt resistor value, power, and amplifier gain for measuring current.'],
      ['NTC thermistor', 'Temperature from resistance, and resistance from temperature, using the Beta equation.'],
      ['Decibels', 'Voltage and power ratios, dB, dBm, and watts.'],
    ];
  }

  /**
   * Builds the WebApplication JSON-LD script for the page head.
   *
   * @return array
   *   A render array for an html_head script element.
   */
  protected function structuredData(): array {
    $request = $this->requestStack->getCurrentRequest();
    $origin = $request ? $request->getSchemeAndHttpHost() : '';
    $page_url = $request ? $origin . $request->getBaseUrl() . $request->getPathInfo() : '';
    $screenshot = $origin . ($request ? $request->getBasePath() : '') . '/' . $this->pathResolver->getPath('module', 'tmwb_electronics_calculators') . '/assets/images/calculators-overview.png';

    $publisher = [
      '@type' => 'Organization',
      'name' => 'TheMakersWorkbench.com',
      'url' => 'https://www.themakersworkbench.com',
    ];

    $data = [
      '@context' => 'https://schema.org',
      '@type' => 'WebApplication',
      'name' => 'Circuit Calculators',
      'url' => $page_url,
      'description' => 'A free set of browser-based electronics calculators: Ohm\'s law and power, LED resistors, voltage dividers, series and parallel resistors and capacitors, RC filters, LC resonance, 555 timers, LM317 regulators, op-amp stages, wire gauge, I2C pull-ups, battery life, thermistors, decibels, and BJT and MOSFET switches, with the formulas and working shown.',
      'applicationCategory' => 'UtilitiesApplication',
      'applicationSubCategory' => 'Electronics calculators',
      'operatingSystem' => 'Any (web browser)',
      'browserRequirements' => 'Requires JavaScript',
      'inLanguage' => 'en',
      'isAccessibleForFree' => TRUE,
      'offers' => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
      'license' => 'https://www.apache.org/licenses/LICENSE-2.0',
      'author' => $publisher,
      'publisher' => $publisher,
      'screenshot' => ['@type' => 'ImageObject', 'url' => $screenshot, 'caption' => 'The Circuit Calculators showing Ohm law'],
      'featureList' => array_map(function ($f) {
        return $f[0] . ': ' . $f[1];
      }, static::features()),
    ];

    return [
      '#type' => 'html_tag',
      '#tag' => 'script',
      '#attributes' => ['type' => 'application/ld+json'],
      '#value' => json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function tips($long = FALSE) {
    return $this->t('A div with the class tmwb-electronics-calculators is replaced by the Circuit Calculators tool.');
  }

}
