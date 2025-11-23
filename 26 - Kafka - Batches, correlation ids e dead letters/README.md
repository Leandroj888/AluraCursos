# Geral
## Iniciar Kafka
docker-compose --profile simple  up
docker-compose --profile cluster up

## Aleterar tópico
''' bash
docker exec -it kafka /opt/kafka/bin/kafka-topics.sh --alter --bootstrap-server localhost:9092 --topic ECOMMERCE_NEW_ORDER --partitions 3
docker exec -it kafka /opt/kafka/bin/kafka-topics.sh --bootstrap-server localhost:9092 --describe --topic ECOMMERCE_NEW_ORDER
'''


# 01. Batches
Um consumer produzir várias mensagens apartir de uma mensagem

# Chamar para processar todos os usuários

- http://localhost:8080/admin/generate-reports

# 02. Serialização e deserialização customizada

CorrelationId -> Concatena as informações de forma que seja possível efetuar a rastreabilidade das chamadas (Isso é uma boa prática)

# 03. CorrelationID

* Lembre-se o serviço de log só pega os topic ao iniciar, então sempre inicie os outros serviços antes e aguarde para iniciar o log

# 04. Arquitetura e falhas até agora

''' bash
docker exec -it kafka /opt/kafka/bin/kafka-consumer-groups.sh --bootstrap-server localhost:9092 --describe --all-groups
'''

heartbeat - batida de coração - termo usado quando um consummer dá pool (pingar) no broken

# 05. Assincronicidade, retry, deadletters

- A ordem que está dentro da partição será respeitada, mas pode acontecer em envio async que a ordem das mensagens sejam embaralhadas ao enviar por causa do max.in.flight.request.per.connection que é 5 por pasdrão e edefini o número de tentativas de enviar uma mensagem e se por questões de falha as mensagens podem ser misturadas quando é async

https://docs.confluent.io/platform/current/installation/configuration/producer-configs.html