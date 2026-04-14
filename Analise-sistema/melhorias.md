# Problemas Identificados 

Ao analisar o comportamento do sistema, podemos inferir os seguintes problemas e riscos em uma possível evolução:

* **Limitações de arquitetura:* Se for um sistema monolítico clássico, um pico de acessos (ex: final de semana em horário de pico) pode derrubar tanto a visualização do cardápio quanto o fechamento de pedidos simultaneamente.
* **Alto acoplamento:** Risco de a interface estar fortemente atrelada ao backend atual. Se a pizzaria quiser lançar um App Nativo (Android/iOS), precisará de uma API totalmente desvinculada das views atuais.
* **Dificuldade de manutenção:** Sistemas construídos rapidamente para web tendem a ter regras de negócio (como cálculo de descontos) misturadas no front-end em JavaScript. Isso obriga duplicação de código caso o sistema escale.

**Melhorias Propostas:**
1. Desacoplar totalmente o frontend do backend adotando uma abordagem API-First.
2. Implementar Cache (ex: Redis) para a visualização do cardápio, diminuindo as requisições ao banco de dados, já que o cardápio não muda com frequência.