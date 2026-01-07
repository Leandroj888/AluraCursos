package com.alura.pix.service;

import com.alura.pix.avro.PixRecord;
import com.alura.pix.dto.PixDTO;
import com.alura.pix.model.Pix;
import com.alura.pix.repository.PixRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.kafka.core.KafkaTemplate;
import org.springframework.stereotype.Service;

@Service
@RequiredArgsConstructor
public class PixService {

    @Autowired
    private final PixRepository pixRepository;
    /*
    @Autowired
    private final KafkaTemplate<String, PixDTO>  kafkaTemplate;

    public PixDTO salvarPix(PixDTO pixDTO) {
        pixRepository.save(Pix.toEntity(pixDTO));
        kafkaTemplate.send("pix-topic", pixDTO.getIdentifier(), pixDTO);
        return pixDTO;
    }
    */
    @Autowired
    private final KafkaTemplate<String, PixRecord>  kafkaTemplate;

    public PixDTO salvarPix(PixDTO pixDTO) {
        pixRepository.save(Pix.toEntity(pixDTO));

        PixRecord pixRecord = PixRecord.newBuilder()
                .setIdentificador(pixDTO.getIdentifier())
                .setChaveOrigem(pixDTO.getChaveOrigem())
                .setChaveDestino(pixDTO.getChaveDestino())
                .setStatus(pixDTO.getStatus().toString())
                .setDataTransferencia(pixDTO.getDataTransferencia().toString())
                .setValor(pixDTO.getValor())
                .build();

        //kafkaTemplate.send("pix-topic", pixDTO.getIdentifier(), pixRecord); //Removido pois será usado kafka connect
        return pixDTO;
    }
}
