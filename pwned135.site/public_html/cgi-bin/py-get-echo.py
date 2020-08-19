#!/usr/bin/python3

import cgi
import cgitb
import os

print("Content-type: text/html\r\n\r\n")
print("<html><head><title>GET query string</title></head>\
	<body><h1 align=center>GET query string</h1>\
  	<hr/>\n")

print("Raw query string: \n<br/>", os.getenv("QUERY_STRING"))
print("\n Formatted Query String:")
raw = cgi.FieldStorage()
for first in raw.keys():
   print(first + '=' + raw.getvalue(first) + "\n")

print("</body>")
print("</html>")
