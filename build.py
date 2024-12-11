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

    if(os.path.isdir(directory + file)):
      if not os.path.isdir(re.sub('^./', './' + root, directory) + file):
        os.mkdir(re.sub('^./', './' + root, directory) + file)
      scan(directory + file + '/')
      continue

    file = directory + file
    if os.path.isfile(re.sub('^./', './' + root, file)):
      if not os.path.getmtime(file) > os.path.getmtime(re.sub('^./', './' + root, file)):
        continue
    if re.search(r'\.html$', file):
      os.system(f'html-minifier "{file}" -o "{re.sub('^./', './' + root, file)}" --collapse-whitespace')
    elif re.search(r'\.js$', file):
      os.system(f'uglifyjs "{file}" -o "{re.sub('^./', './' + root, file)}" -c -m')
    elif re.search(r'\.css$', file):
      os.system(f'cleancss -o "{re.sub('^./', './' + root, file)}" "{file}"')
    else:
      os.system(f'cp "{file}" "{re.sub('^./', './' + root, file)}"')
    

scan()