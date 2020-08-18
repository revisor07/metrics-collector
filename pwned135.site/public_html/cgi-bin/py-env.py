#!/usr/bin/python3

import cgi
import cgitb
import os

print("Content-type: text/html\r\n\r\n")

print("<h1 align='center'>Environment Variables</h1><hr />")
for param in os.environ.keys():
        print("<b>%20s</b>: %s</br>" % (param, os.environ[param]))
