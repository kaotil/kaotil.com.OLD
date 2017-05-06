#FROM busybox
FROM alpine:latest
MAINTAINER kaotil

#VOLUME /data

#RUN apk add --update git \
#  && rm -rf /var/cache/apk/* \
#  && mkdir -p /data/web/html
#RUN mkdir -p /tmp/web/html
#RUN echo 'tes' > /tmp/web/html/test2.txt

#WORKDIR /tmp/web/html
#RUN git clone https://github.com/kaotil/kaotil.com.git

RUN apk add --update --no-cache git \
  && mkdir -p /opt/web
WORKDIR /opt/web
RUN git clone https://github.com/kaotil/kaotil.com.git

VOLUME /opt

CMD /bin/sh
