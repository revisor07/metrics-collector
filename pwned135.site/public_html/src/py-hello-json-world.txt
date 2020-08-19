#!/usr/bin/python3

import time
import cgi
import json
import os

print("Cache-Control: no-cache")
print("Content-type: application/json\r\n\r\n")
print("{\n\t\"message\": \"Hello World\",\n")
print("\t\"date\":", time.ctime(), "\n")
print("\t\"currentIP\": ", os.getenv("REMOTE_ADDR"), "\n}")
