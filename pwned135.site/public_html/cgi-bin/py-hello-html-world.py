#!/usr/bin/python3

import time
import os
import cgi
import cgitb

#Print HTML header
print("Cache-Control: no-cache")
print("Content-type:text/html\r\n\r\n")
print('<html>')
print('<head>')
print('<title>Team Pwned</title>')
print('</head>')
print('<body>')
print('<h1 align=center>Team Pwned</h1>\n')

print('<br>This program was generated at: ', time.ctime(), '</br>')
print(" \n")
print('<br>Your current IP address is: ', os.getenv("REMOTE_ADDR"), '</br>')
print("</body></html>")
#Print HTML footer


