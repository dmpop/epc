#!/usr/bin/env bash

container=$(buildah from alpine:latest)
buildah run $container apk update
buildah run $container apk add php-cli php-intl
buildah copy $container . /usr/src/epc/
buildah config --workingdir /usr/src/epc $container
buildah config --port 8000 $container
buildah config --cmd "php -S 0.0.0.0:8000" $container
buildah config --label description="EPC container image" $container
buildah config --label maintainer="dmpop@linux.com" $container
buildah config --label version="0.1" $container
buildah commit --squash $container epc
buildah rm $container