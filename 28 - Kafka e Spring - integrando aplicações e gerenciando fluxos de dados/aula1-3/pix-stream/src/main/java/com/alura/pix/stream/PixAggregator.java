package com.alura.pix.stream;

import com.alura.pix.dto.PixDTO;
import com.alura.pix.serdes.PixSerdes;
import org.apache.kafka.common.serialization.Serdes;
import org.apache.kafka.streams.StreamsBuilder;
import org.apache.kafka.streams.kstream.*;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service
public class PixAggregator {

    @Autowired
    public void aggregator(StreamsBuilder streamsBuilder) {
        /*
        // Apenas captura
        KStream<String, PixDTO> messageStream = streamsBuilder
                .stream("pix-topic", Consumed.with(Serdes.String(), PixSerdes.serdes()))
                .peek((key, value) -> System.out.println("Pix recebido de : " + value.getChaveOrigem()))
                .filter((key, value) -> value.getValor() > 1000);

        messageStream.print(Printed.toSysOut());
        messageStream.to("pix-topic-verificacao-fraude", Produced.with(Serdes.String(), PixSerdes.serdes()));
        */
        // Realiza processamento
        KTable<String, Double> tableStream = streamsBuilder
                .stream("pix-topic", Consumed.with(Serdes.String(), PixSerdes.serdes()))
                .peek((key, value) -> System.out.println("Pix recebido de : " + value.getChaveOrigem()))
                .groupBy((key, value) -> value.getChaveOrigem())
                .aggregate(
                        () -> 0.0, //Começa em quanto
                        (key, value, aggregate) -> (aggregate + value.getValor()), // operação
                        Materialized.with(Serdes.String(), Serdes.Double()) // Local onde será armazenado
                );

        tableStream.toStream().print(Printed.toSysOut());
        tableStream.toStream().to("pix-topic-agregacao", Produced.with(Serdes.String(), Serdes.Double()));
    }

}
