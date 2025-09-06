package com.joaovidal.producer_service.controller;

import com.joaovidal.producer_service.config.RabbitConfig;
import org.slf4j.LoggerFactory;
import org.springframework.amqp.rabbit.core.RabbitTemplate;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import org.slf4j.Logger;

@RestController
@RequestMapping("foda/")
public class ControllerFoda {

    private final RabbitTemplate templateFoda;

    private static final Logger log = LoggerFactory.getLogger(ControllerFoda.class);

    public ControllerFoda(RabbitTemplate templateFoda) {
        this.templateFoda = templateFoda;
    }

    @PostMapping("quem")
    public void Envia(@RequestParam String papo) {
        templateFoda.convertAndSend(RabbitConfig.EXCHANGE_NAME, RabbitConfig.ROUTING_KEY, papo);
        log.info("muito foda que deu certo: " + papo);
    }
}
