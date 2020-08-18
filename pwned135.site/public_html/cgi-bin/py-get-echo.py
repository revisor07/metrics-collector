#!/usr/bin/python3

import time
import cgi
import cgitb
import json
import os

print("Content-type: text/html\r\n\r\n")
print("<html><head><title>GET query string</title></head>\
	<body><h1 align=center>GET query string</h1>\
  	<hr/>\n")

print("Raw query string: \n<br/><br/>", os.getenv("QUERY_STRING"))
print("<table> Formatted Query String:")
query = cgi.FieldStorage()
for key in query.keys():
   print("\n" + key + '=' + query.getvalue(key))
print("</table>")

print("</body>")
print("</html>")
