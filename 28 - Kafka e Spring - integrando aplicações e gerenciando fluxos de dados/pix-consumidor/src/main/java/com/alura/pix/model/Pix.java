package com.alura.pix.model;

import com.alura.pix.avro.PixRecord;
import com.alura.pix.dto.PixStatus;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;

import  com.alura.pix.dto.PixDTO;


import java.time.LocalDateTime;

@Entity
@Getter
@Setter
public class Pix {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer id;
    private String identifier;
    private String chaveOrigem;
    private String chaveDestino;
    private Double valor;
    private LocalDateTime dataTransferencia;
    @Enumerated(EnumType.STRING)
    private PixStatus status;

    public static Pix toEntity(PixRecord pixRecord) {
        Pix pix = new Pix();
        pix.setIdentifier(pixRecord.getIdentificador());
        pix.setChaveDestino(pixRecord.getChaveDestino());
        pix.setStatus(PixStatus.fromString(pixRecord.getStatus()));
        pix.setValor(pixRecord.getValor());
        pix.setDataTransferencia(LocalDateTime.parse(pixRecord.getDataTransferencia()));
        pix.setChaveOrigem(pixRecord.getChaveOrigem());
        return pix;
    }
}
