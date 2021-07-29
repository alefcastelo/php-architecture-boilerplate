```shell
protoc -I=. config/proto/*.proto  --php_out=./grpc --grpc_out=./grpc --plugin=protoc-gen-grpc=/usr/local/bin/grpc_php_plugin
protoc -I=. config/proto/*.proto  --go_out=plugins=grpc:pb
```