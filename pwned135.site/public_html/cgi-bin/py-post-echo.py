#!/usr/bin/python3

import json
import os
import cgi
import cgitb

print("Content-type:text/html\r\n\r\n")
print("<html><head><title>POST Request Echo</title></head><body><h1 align=center>POST Request Echo</h1><hr/>\n")

print("<b>Message Body:</b></br>\n")
raw = cgi.FieldStorage()
for first in raw.keys():
   print(first + '=' + raw.getfirst(first) + "\n")

print("</body>")
print("</html>")
