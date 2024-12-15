#!/bin/python

import os
import re

root = 'build/'
buildFile = 'build.py'

if not os.path.exists(root):
  os.mkdir(root)

def scan(directory = './'):
  files = os.listdir(directory)
  for file in files:
    if file[0] == '.':
      continue
    if file + '/' == root and directory == './':
      continue
    if file == buildFile and directory == './':
      continue

    build_path = re.sub('^./', './' + root, directory) + file;
    if(os.path.isdir(directory + file)):
      if not os.path.isdir(build_path):
        os.mkdir(build_path)
        os.system('chmod 755 ' + build_path)
      scan(directory + file + '/')
      continue

    file = directory + file
    if os.path.isfile(build_path):
      if not os.path.getmtime(file) > os.path.getmtime(build_path):
        os.system('chmod 755 ' + build_path)
        continue
    if re.search(r'\.(html|php)$', file):
      os.system(f'html-minifier --minify-js true "{file}" -o "{build_path}" --collapse-whitespace')
    elif re.search(r'\.js$', file):
      os.system(f'uglifyjs "{file}" -o "{build_path}" -c -m')
    elif re.search(r'\.css$', file):
      os.system(f'cleancss -o "{build_path}" "{file}"')
    else:
      os.system(f'cp "{file}" "{build_path}"')
    os.system('chmod 755 ' + build_path)
    

scan()