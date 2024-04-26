###################################################################
# AUTHOR:      Cameron Cheung                                     #
#                                                                 #
# DESCRIPTION: This script takes a CSV file listing all members   #
#              of GamesCrafters and their survey responses and    #
#              image paths, and creates a file members.csv        #
###################################################################

import sys
import re
import csv

lines_to_sort = []

# Check that an preprocessed CSV filepath is specified.
if len(sys.argv) != 2:
    print("You must specify the path to the preprocessed CSV containing members' survey responses and image paths.")
    print('USAGE: python3 process.py <path>')
    exit(1)

# Open the CSV file and add all lines to `lines_to_sort`.
with open(sys.argv[1], mode ='r') as file:
    csvFile = csv.DictReader(file)
    for line in csvFile:
        lines_to_sort.append(line)

# Check that all names are not empty strings and that the semesterjoined is in a valid format.
pattern = re.compile(r"\b(Spring|Fall)\b 2\d{3}$")
for line in lines_to_sort:
    if line['name'] == '':
        print('ERROR: Invalid value of "name". Must not be an empty string.')
        print('The error occurred on the following line of the CSV file:')
        print(line)
        exit(1)
    if not re.fullmatch(pattern, line['semesterjoined']):
        print('ERROR: Invalid value of "semesterjoined". A valid semester name begins with either "Spring" or "Fall", followed by a space, followed by a year between 2000 and 2999 inclusive.')
        print('The error occurred on the following line of the CSV file:')
        print(line)
        exit(1)

# Convert a semester string, e.g. "Spring 2024" to 
# an integer that is used for sorting semester names
def convert_semester_str_to_int(semester_str):
    num = 0
    if 'Fall' in semester_str:
        num += 1
    num += (int(semester_str[-4:]) - 2001) * 2
    return num

# Sort the lines of the CSV file by SemesterJoined DESC, Name DESC
lines_to_sort.sort(
    reverse=True,
    key=lambda line: (convert_semester_str_to_int(line['semesterjoined']), line['name'])
)

# Count the number of members and add a column for member number
# The members are numbered from n to 1, where n is the total number of
# members listed in the CSV file.
count = len(lines_to_sort)
for line in lines_to_sort:
    line['number'] = count
    count -= 1

# Column names for the processed CSV output file
fields = ['number', 'name', 'semesterjoined', 'year', 'listofsemesters', 'major', 'game', 'icecream', 'projects', 'biography', 'quote', 'citation', 'image', 'crazyimage']
 
# Write to output CSV file, for use in gamescrafters.berkeley.edu members tab
with open("./members.csv", 'w') as csvfile:
    writer = csv.DictWriter(csvfile, fieldnames=fields)
    writer.writeheader()
    writer.writerows(lines_to_sort)