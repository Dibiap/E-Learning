#!/bin/bash

# Function to display usage information
usage() {
    echo "Usage: $0 <directory> <search_string>"
    exit 1
}

# Check if the correct number of arguments are provided
if [ "$#" -ne 2 ]; then
    usage
fi

# Assign arguments to variables
DIRECTORY=$1
SEARCH_STRING=$2

# Check if the provided directory exists
if [ ! -d "$DIRECTORY" ]; then
    echo "Error: Directory '$DIRECTORY' does not exist."
    exit 1
fi

# Search for the string in the specified directory recursively
grep -rnw "$DIRECTORY" -e "$SEARCH_STRING"

# Explanation:
# -r : recursive search through directories
# -n : show the line number where the string is found
# -w : match the whole word
# -e : the pattern to search for

# If grep doesn't find anything, it will return a non-zero status code.
if [ $? -ne 0 ]; then
    echo "No matches found for '$SEARCH_STRING' in '$DIRECTORY'."
fi

