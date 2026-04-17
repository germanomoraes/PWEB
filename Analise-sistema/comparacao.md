## Parte 5: Comparação com Sistema Didático

| Critério | Sistema  (Tropykaly) | Sistema Didático |
| :--- | :--- | :--- |
| **Arquitetura** | Cliente-Servidor distribuída, baseada em nuvem. | Monolítico, execução local simples. |
|  |  |  |
| **Coesão** | Alta (módulos focados em funções únicas). | Baixa (lógicas misturadas na mesma classe/arquivo). |
|  |  |  |
| **Acoplamento**| Baixo (Comunicação via API entre Front/Back). | Alto (Classes altamente dependentes entre si). |
|  |  |  |
| **Organização** | Uso de Padrões de Projeto (MVC, etc). | Estrutura procedural ou sem padrão definido. |
|  |  |  |
| **Flexibilidade**| Alta (Fácil escalar e adicionar produtos). | Baixa (Alterações causam quebras no sistema). |
|  |  |  |

**Explicação das principais diferenças:**
O sistema real é preparado para concorrência (múltiplos usuários simultâneos) e segurança, exigindo uma arquitetura desacoplada e escalável. O sistema didático foca apenas em validar um fluxo lógico, negligenciando otimizações de performance e organização estrutural.

## Parte 10: Reflexão Crítica

**1. É possível modelar um sistema sem ver o código?**

Sim. Através da engenharia reversa comportamental, mapeamos entradas, saídas, fluxos de tela e regras de negócio para inferir as entidades e arquitetura por trás da interface.

**2. Qual a importância da modelagem?**

Ela fornece uma visão abstrata e arquitetural do sistema. Ajuda a documentar, planejar melhorias, encontrar gargalos e facilita a comunicação técnica sem a necessidade de ler linhas de código.

**3. Diferença entre sistema real e didático?**

Sistemas reais exigem tolerância a falhas, segurança de dados e padrões rigorosos para manutenção a longo prazo. Sistemas didáticos são ambientes controlados com foco estrito em aprendizado pontual.
