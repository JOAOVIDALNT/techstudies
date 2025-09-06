package com.joaovidal.consumer_service;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.amqp.rabbit.annotation.RabbitListener;
import org.springframework.stereotype.Component;

@Component
public class ListenerFoda {
    private static final Logger log = LoggerFactory.getLogger(ListenerFoda.class);

    @RabbitListener(queues = "filafoda")
    public void Recebe(String papo) {
        log.info("Producer deu o papo: " + papo);
    }
}
