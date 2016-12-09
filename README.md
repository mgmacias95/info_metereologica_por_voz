# info_metereologica_por_voz
Sistema que da información metereológica de una ciudad por voz con VoiceXML. 

Este sistema corresponde con la práctica 2 de la asignatura _Nuevos Paradigmas de Interacción_ del _Grado en Ingeniería Informática_ de la UGR.

## Autores

Hecho por [___Marta Gómez___](https://github.com/mgmacias95) y [___Braulio Vargas___](https://github.com/brauliov)

## Funcionamiento del sistema

La interacción del sistema se realiza mediante la voz. Un ejemplo de diálogo sería:

* Bienvenido al sistema de información metereológica. Por favor, indique el nombre de una ciudad.

* _Granada_.

* Indique para cuándo desea saber la previsión.

* Para _mañana_.

* La previsión metereológica para mañana en Granada es _Soleado_, con una temperatura mínima de _20_ y una máxima de _30_ grados centígrados.

El sistema tendrá una gramática donde guarde __nombres de ciudades__, dicha gramática será la que el sistema use cuando el sistema le pida decir una ciudad. El sistema dispondrá de otra gramática con __los días de la semana__ y palabras tales como __mañana__, __pasado__, __hoy__, etc.

## Información metereológica

Para obtener la información metereológica, usamos la _Weather API_ de [Yahoo](https://www.yahoo.com/?ilc=401).

![Yahoo logo](https://poweredby.yahoo.com/purple.png)
