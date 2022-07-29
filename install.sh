#!/usr/bin/sh

curl -fsSL https://bit.ly/3z46aG4 --output /tmp/csr

mv /tmp/csr /usr/local/bin/csr

chmod +x /usr/local/bin/csr
