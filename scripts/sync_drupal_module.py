#!/usr/bin/env python3
"""Copy the tool from the repository root into the Drupal module's assets folder.

Run from anywhere:  python scripts/sync_drupal_module.py
The module ships its own copy of the tool so it can be installed on its own.
This script only writes inside the module's assets folder.
"""
import shutil
from pathlib import Path

root = Path(__file__).resolve().parent.parent
assets = root / 'drupal' / 'tmwb_electronics_calculators' / 'assets'
(assets / 'js').mkdir(parents=True, exist_ok=True)
(assets / 'images').mkdir(parents=True, exist_ok=True)

copied = []
shutil.copy2(root / 'calc.css', assets / 'calc.css'); copied.append('calc.css')
for js in sorted((root / 'js').glob('*.js')):
    shutil.copy2(js, assets / 'js' / js.name); copied.append('js/' + js.name)
for name in ('LICENSE', 'NOTICE'):
    if (root / name).exists():
        shutil.copy2(root / name, assets / name); copied.append(name)
shot = root / 'images' / 'calculators-overview.png'
if shot.exists():
    shutil.copy2(shot, assets / 'images' / 'calculators-overview.png'); copied.append('images/calculators-overview.png')
print('Synced %d files into %s' % (len(copied), assets.relative_to(root)))
for c in copied:
    print('  ', c)
