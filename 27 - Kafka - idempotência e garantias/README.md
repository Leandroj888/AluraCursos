# Geral
## Start Kafka

docker-compose --profile simple  up
docker-compose --profile cluster up


## Accesses

- http://localhost:8080/admin/generate-reports
- http://localhost:8080/new?email=leandrojunges@yahoo.com.br&amount=153&uuid = 45641646452131

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

Ao usar AUTO_OFFSET_RESET_CONFIG define por onde começar,
    - **latest** é a última mensgaem, ou seja, não processa antigas
    - **earliest** seria desde a mensagem mais antiga não processada
    - **disable** não levanta se não tiver

# 04. Lidando com mensagens duplicadas

Caso deseje uma garantia que a mensagens serão processadas será necessário armazenar os ofset(endereço, índice) do tópico e partição que está consumindo e fazer o ajuste manual sempre que o sistema iniciar para avançar até onde o cursor estava e continuar desse ponto.

Isso garante que a mensagem será sempre lida e processada mas demanda mais atenção e guardar index e comitar no kafka manualmente (depende)

# 05. Indempotência

Indepotência é a capacidade de mesmo receber várias vezes apenas aplica uma vez
    - No ponto 04 temos que armazenar o offset mas se tivermos um identificador na mensagem podemos armazenar no banco o identificador e mesmo se tiver reprocessamento não quebra o sistema pois o que foi processado não será processado novamente


FastDelegate - criar uuid automâticamente no processo inicial