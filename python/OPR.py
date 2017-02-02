#! /usr/bin/python

import time

print 'hi'

counter = 0 


while True:
	counter = counter + 1
	print str(counter)
	time.sleep(10)
	print 'hi'

	file = open("/developer/TheOrangeAlliance/python/testfile.txt","w")

	file.write(str(counter))
 
	file.write('Hello World') 
	file.write('Why? Because we can.') 

	file.close()
