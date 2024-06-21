#!/bin/bash

# Check if a hostname is provided
if [ -z "$1" ]; then
    {
    echo "Usage: $0 [host]"
    echo "Scan ports on the specified non-SSL host."
    echo
    echo "Example:"
    echo "  $0 127.0.0.1"
    exit 1
}
fi

host=$1  # Assign the provided hostname to a variable

# Perform the scan
echo -e "Scanning ports on $host\n"
hostname=$1  # Assign the provided hostname to a variable
for port in {1..65535}; do 
    if nc -zw1 $hostname $port ; then  # Attempt to connect to the port using SSL
        echo "Discovered open port $port/tcp on $hostname"
    fi
done
