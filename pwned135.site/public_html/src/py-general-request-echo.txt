#!/usr/bin/python3

import cgi
import cgitb
import os

print("Cache-Control: no-cache")
print("Content-type: text/html \r\n\r\n")

# print HTML file top
print("<!DOCTYPE html><html><head><title>General Request Echo</title></head><body>")
print("<h1 align=center>General Request Echo</h1><hr>")


print("<p><b>HTTP Protocol:</b> ", os.getenv("SERVER_PROTOCOL"), "</p>")
print("<p><b>HTTP Method:</b> ", os.getenv("REQUEST_METHOD"), "</p>")
print("<p><b>Query String:</b> ", os.getenv("QUERY_STRING"), "</p>")

# NOTE: Although the Query String is an environment variable, the Message Body
# must be read in from the Standard Input with any language using CGI.
# Credit for this code to read in STDIN in Perl comes from:
# https://stackoverflow.com/questions/30447317/how-to-handle-post-request-to-perl-from-html

print("<p><b>Message Body:</b> </p>")

raw = cgi.FieldStorage()
for first in raw.keys():
   print(first + '=' + raw.getvalue(first) + "\n")

# Print the HTML file bottom
print("</body></html>\n")
