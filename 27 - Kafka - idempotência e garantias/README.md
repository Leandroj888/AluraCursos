# Geral
## Start Kafka

docker-compose --profile simple  up
docker-compose --profile cluster up


## Accesses

- http://localhost:8080/admin/generate-reports
- http://localhost:8080/new?email=leandrojunges@yahoo.com.br&amount=153

# 01, Organizing email service


# 02. Service Layer

- KafkaProducer is thread safe
- KafkaConsumer is NOT thread safe the best pratic is one consumer per thread and this trigger for other thread process the data

''' bash
docker exec -it kafka /opt/kafka/bin/kafka-topics.sh --bootstrap-server localhost:9092 --describe --topic ECOMMERCE_SEND_EMAIL
docker exec -it kafka /opt/kafka/bin/kafka-consumer-groups.sh --bootstrap-server localhost:9092 --all-groups --describe
'''

- newFixedThreadPool if one thread broken this function started a new thread for substitute the broked

# 03. Commits and offsets