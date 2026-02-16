FROM ubuntu:latest

EXPOSE 8000

WORKDIR /app

COPY ./main main

ENV HOST=localhost PORT=5432

ENV USER=root PASSWORD=root DBNAME=root

CMD ["./main"]