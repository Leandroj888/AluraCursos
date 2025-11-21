# Geral
## Iniciar Kafka
docker-compose  --profile simple  up

## Aleterar tópico
''' bash
docker exec -it kafka /opt/kafka/bin/kafka-topics.sh --alter --bootstrap-server localhost:9092 --topic ECOMMERCE_NEW_ORDER --partitions 3
docker exec -it kafka /opt/kafka/bin/kafka-topics.sh --bootstrap-server localhost:9092 --describe --topic ECOMMERCE_NEW_ORDER
'''


# 01. Novos produtores e consumidores

## Atenção
Ao usar pattern a lista de topicos é atualizada só quando o serviço inicia, se um novo tópico for inserido é necessário reiniciar o serviço

# 02. Evoluindo um serviço

- Gson Deserializer ignora campos a mais


# 03. Servidor HTTP

- http://localhost:8080/new?email=leandrojunges@yahoo.com.br&amount=153


# 04. Cluster de Brokes

- Single point of failure do broker | Quando se têm um ponto de falha 
- Será necessário injetra novos enviroments nos serviços (usar portas diferentes)
      - KAFKA_OFFSETS_TOPIC_REPLICATION_FACTOR: 2
      - KAFKA_TRANSACTION_STATE_LOG_REPLICATION_FACTOR: 2
      - KAFKA_TRANSACTION_STATE_LOG_MIN_ISR: 1
      - KAFKA_CLUSTER_ID: Identificador de cluster
      - KAFKA_NODE_ID: mudar o número para cada cluster
      - KAFKA_CONTROLLER_QUORUM_VOTERS: mapear todos endereços aqui
      - KAFKA_DEFAULT_REPLICATION_FACTOR: 2 - define quantidade de replocas
      - KAFKA_MIN_INSYNC_REPLICAS: 1 - mínimo de servidores de pé parar continuar funcionando



## Subir cluster
''' bash
docker-compose --profile cluster up
'''

