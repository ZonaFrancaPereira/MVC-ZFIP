-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2025 a las 23:16:39
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `zfip`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acpm`
--

CREATE TABLE `acpm` (
  `id_consecutivo` int(11) NOT NULL,
  `origen_acpm` text DEFAULT NULL,
  `fuente_acpm` enum('AI','AE','Otros') DEFAULT NULL,
  `descripcion_fuente` text DEFAULT NULL,
  `tipo_acpm` enum('AC','AP','AM') DEFAULT NULL,
  `fecha_acpm` timestamp NULL DEFAULT current_timestamp(),
  `descripcion_acpm` text DEFAULT NULL,
  `causa_acpm` text DEFAULT NULL,
  `nc_similar` enum('Si','No') DEFAULT NULL,
  `descripcion_nsc` text DEFAULT NULL,
  `correccion_acpm` text DEFAULT NULL,
  `fecha_correccion` date DEFAULT NULL,
  `estado_acpm` enum('Abierta','Proceso','Cerrada','Rechazada','Verificacion','Abierta Vencida') DEFAULT NULL,
  `riesgo_acpm` enum('Si','No') DEFAULT NULL,
  `justificacion_riesgo` text DEFAULT NULL,
  `cambios_sig` enum('Si','No') DEFAULT NULL,
  `justificacion_sig` text DEFAULT NULL,
  `conforme_sig` enum('Si','No') DEFAULT NULL,
  `justificacion_conforme_sig` text DEFAULT NULL,
  `fecha_estado` date DEFAULT NULL,
  `fecha_finalizacion` date DEFAULT NULL,
  `id_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `acpm`
--

INSERT INTO `acpm` (`id_consecutivo`, `origen_acpm`, `fuente_acpm`, `descripcion_fuente`, `tipo_acpm`, `fecha_acpm`, `descripcion_acpm`, `causa_acpm`, `nc_similar`, `descripcion_nsc`, `correccion_acpm`, `fecha_correccion`, `estado_acpm`, `riesgo_acpm`, `justificacion_riesgo`, `cambios_sig`, `justificacion_sig`, `conforme_sig`, `justificacion_conforme_sig`, `fecha_estado`, `fecha_finalizacion`, `id_usuario_fk`) VALUES
(1, 'Se observa la necesidad de implementar la realizacion del Backup automatico', 'Otros', 'N/A', 'AM', '2024-01-03 19:02:17', 'Es necesario implementar una medida que automatice la copia de seguridad diaria en cada equipo, eliminando la necesidad de que los colaboradores realicen esta tarea manualmente. ', 'N/A', 'No', '', NULL, NULL, 'Cerrada', 'Si', 'Se realizan  todas las actividades planteadas para la AM implementadas, contando con evidencia suficiente para cada actividad, por lo tanto se cierra de manera EFICAZ la presente acción.', 'No', 'N/A', 'Si', 'Actualizar el manual de TI*** por favor incluir la metodología en el manual', '2024-08-28', '2024-11-01', 2),
(2, 'Inspección de RACKS de telecomunicaciones:\n• Rack Principal\n• Rack TR-02 \n• Rack Operaciones\n• Rack de Monitoreo', 'Otros', 'N/A', 'AP', '2024-01-03 19:42:10', 'Se llevó a cabo un peinado de cada uno de los racks de comunicaciones, identificando la necesidad de etiquetar los cables y crear un mapeo detallado de cada conexión. El objetivo es agilizar la respuesta ante cualquier novedad de manera óptima y poder identificar fácilmente cuál de las conexiones está generando conflictos.', '¿Por qué? No se realizó una identificación adecuada de los cables durante la instalación.\n¿Por qué? Falta de procedimientos o protocolos claros para etiquetar los cables en la infraestructura de comunicaciones.\n¿Por qué? No se habia reconocido la necesidad de implementar el etiquetado para facilitar la gestión y resolución de problemas.\n¿Por qué? Se reconoce la importancia de una respuesta rápida ante problemas de conexión y errores en procesos específicos.', 'No', '', NULL, NULL, 'Cerrada', 'Si', 'Se ejecutaron todas las actividades propuestas dentro del plan de trabajo, trazando la evidencia de las mismas en el aplicativo y cumpliendo con el objetivo de la AP levantada para el proceso, por lo tanto se da por cerrada de manera EFICAZ la presente AP.', 'No', 'N/A', 'No', 'N/A', '2024-06-12', '2024-07-05', 2),
(3, 'Se observa la necesidad de estandarizar los valores para viáticos nacionales e internacionales, gastos de viaje y valor mínimo de facturas pagadas a través de caja menor presentes en el manual financiero (MA-FI-01). ', 'Otros', '', 'AM', '2024-01-25 15:14:46', 'Es necesario registrar los valores en función de tarifas de acuerdo con variables macroeconómicas, con el fin de garantizar que el manual se encuentre actualizado y también para garantizar que se otorguen los gastos de acuerdo con los precios vigentes en el país. ', '', 'No', '', NULL, NULL, 'Cerrada', 'Si', 'Se ejecutan el total de las actividades planeadas para la presente acción, por lo tanto se cierra de manera EFICAZ, al encontrarse todas las evidencias que soportan dicha acción', 'No', 'N/A', 'No', 'N/A', '2024-08-05', '2024-07-30', 6),
(4, 'Se evidencia  la necesidad de compartir  tips de  revisión de  formularios de mercancías para garantizar  una revisión integral a la información, por parte de todos los analistas de operaciones. ', 'Otros', '', 'AM', '2024-01-31 21:18:43', 'Se realizará envió de correos con tips de aprobación de formularios  por parte de todo el equipo de operaciones, retroalimentando   la actividad de revisión y aprobación de formularios.', '', 'No', '', NULL, NULL, 'Cerrada', 'Si', 'Se observa ejecución de las actividades descritas en el plan de trabajo', 'No', 'n/a', 'Si', 'Se observa ejecución de las actividades descritas en el plan de trabajo', '2024-03-19', '2024-04-30', 7),
(5, 'Resolución 2747 del 2017 - Por la cual se prohíbe la importación de sustancias agotadoras de la capa ozono ', 'Otros', '', 'AP', '2024-02-21 15:21:22', 'Se identifico la existencia de extintores de Solkaflam en las areas administrativas, dada a la  Resolución 2749 de 2017 se Por la cual se prohíbe la importación de las sustancias agotadoras de la capa de ozono listadas en los grupos II y III del Anexo C del Protocolo de Montreal, Por lo cual para contribuir con el cumplimiento y la prevención y seguridad en instalaciones se realiza el cambio de extintores de compuesto químico ( HCFC-123) por extintores de Co2.', '- Falta de verificación normativa con base a equipos activos en las instalaciones.\n- Continuidad y falta de proyección a mejora.', 'No', '', NULL, NULL, 'Cerrada', 'Si', 'N/A', 'No', 'N/A', 'No', 'N/A', '2024-09-13', '2024-09-30', 27),
(6, 'Indicador de Presupuestos año 2023 por área y presupuesto general. ', 'AI', '', 'AC', '2024-02-22 21:09:27', 'Mejorar las acciones que permitan el control a la ejecución global de los presupuestos, garantizando siempre la proyección aprobada por la asamblea y la ejecución menor o igual a 100%. Así mismo validar el correcto uso de herramienta de control de presupuesto mes a mes por área.', 'Durante el año 2023 se identificó que algunas áreas de la compañía presentaron errores de sumatoria en la herramienta de control  de presupuestos, al igual que diferencias entre el presupuesto aprobado en por la asamblea y el valor registrado en la herramienta de inventario. ', 'Si', 'Indicador de presupuesto en las siguientes áreas: \n1. Área técnica en Etapa II: Que presento una diferencia en el indicador equivalente 20.94%, ocasionada por error en las sumatorias del excel desde el mes de marzo de 2023. \n2. Área Jurídica: Que presentó una diferencia en el presupuesto acumulado equivalente a 35.96%, ocasionada por la omisión en el diligenciamiento de la herramienta durante los meses de mayo a agosto de 2023. \n3. Área de Operación: Pequeña diferencia entre el valor de presupuesto autorizado por la Asamblea General de Accionistas y el valor reportado mes a mes en el indicador. ', NULL, NULL, 'Cerrada', 'Si', 'Se realizan las actividades planeadas para esta acción de manera completa, por lo tanto se cierra la presente acción EFICAZMENTE', 'No', 'N/A', 'No', 'N/A', '2024-08-05', '2024-07-30', 6),
(7, 'Informes de gestion año 2023.', 'Otros', '', 'AC', '2024-03-19 19:09:36', 'Incumplimiento del indicador de seguridad de la Etapa 2 de la Zona Franca Internacional de Pereira para el año 2023.', 'Por que no se tenia un formato de revision claro para las revistas diarias.\npor que no se tenia claro que era lo que se queria medir con el formato establecido.\nPor que  ocurrieron cambios constantes de la Etapa 2 en su infraestructura fisica.\nPor que surgieron cambios de perosnal constantes del area de mantenimiento quienes eran los encargados de pasar las revistas correspondientes.\nPor que el cargo de jefe de seguridad estaba siendo compartido con el administrador de PH y no se cuenta con recursos propios para ello.\n\n\n', 'Si', 'El sistema de gestion por el cumplimiento de indicadores internos de ZFIP.', NULL, NULL, 'Cerrada', 'Si', 'Se realizan todas las actividades programadas para la presente acción, por lo tanto se cierra de manera EFICAZ', 'No', 'N/A', 'No', 'N/A', '2024-09-25', '2024-03-22', 59),
(8, 'Informes de Gestion año 2023 - GAD -RSE', 'Otros', '', 'AC', '2024-03-19 22:38:35', 'Incumplimiento al objetivo estrategico del proceso de Gestion Administratiova teniendo en cuenta el resultado  del indicador de Responsabilidad Social Empresarial para el año 2023 en ZFIP.\n\n', 'Por que se estaban realizando actividades de RSE pero no se estaban dejando registros de ello.\nPor que no se contaba con un cronograma de actividades establesido para RSE.\nPor que no se estaba realizando el respectivo seguimiento a las actividades realizadas por la persona contratada para esta labor.\nPor que no se habia socializado con la comunidad y con las empresas  la persona encargada de la labor de RSE.\nPor que la gestora de RSE no tenia claro el contacto que debia tener con las empresas y no se habia socializado el programa correspondiente desde ZFIP -  UO y La Agrupacion.\n\n', 'Si', 'El sistema de gestion por el cumplimiento de indicadores internos de ZFIP.\n', NULL, NULL, 'Cerrada', 'Si', 'Se observa ejecución del total de las actividades propuesta para la presente acción,  por lo tanto se cierra la presente acción de manera EFICAZ', 'No', 'N/A', 'No', 'N/A', '2024-06-28', '2024-03-30', 27),
(9, 'INCUMPLIMIENTO DE LOGRO ANUAL (2023) DEL INDICADOR DE MANTENIMIENTO DE INFRAESTRUCTURA. LA META ES DEL 90% Y SE LLEGÓ AL 82.92%', 'AI', '', 'AC', '2024-03-22 13:42:04', 'Incumplimiento en las actividades de: fumigación del jarillón de etapa 2, inventario y organización del almacén, fumigación y control de plagas del edificio Usuario Operador, y limpieza de tanques elevados.', 'El incumplimiento en las actividades responde a:\n1. Porque no se contaba con el personal necesario para atender las actividades\n2. Porque habían otras prioridades como el avance y/o entrega de las obras de etapa 2.\n3. Porque no se tuvo en cuenta programar los servicios necesarios.\n4. Porque no se determinaron correctamente las frecuencias de los mantenimientos.', 'No', '', NULL, NULL, 'Abierta Vencida', 'No', '', NULL, NULL, NULL, NULL, '2024-03-22', '2024-03-30', 14),
(19, 'Después de una revisión por parte del SIG.', 'Otros', '0', 'AM', '2024-04-23 20:09:53', 'Se debe acoplar el Manual de Gestión de Tecnología e Informática a las actualización de la plataforma ZFIP, sin embargo se debe tener siempre un plan de contingencia el uso de los formatos en caso de fallas en la plataforma.', '', 'No', '', NULL, NULL, 'Abierta Vencida', 'No', '', NULL, NULL, NULL, NULL, '2024-04-23', '2024-12-23', 2),
(20, 'Auditoría Interna ', 'AI', '', 'AM', '2024-05-24 20:48:54', 'Actualización del manual comercial y de servicio al cliente. codificado MAGG-01', 'Se requiere actualizar el manual para describir los responsables del procedimiento . ', 'No', '', NULL, NULL, 'Abierta Vencida', 'Si', 'Que no exista claridad de la responsabilidad de los involucrados. ', NULL, NULL, NULL, NULL, '2024-05-24', '2024-06-20', 11),
(28, 'Verificación por Auditoria Interna', 'AI', '', 'AC', '2024-06-06 19:37:19', 'Se realizó auditoria interna encontrándose como resultado falencia en la documentación recolectada para el asociado de negocio Velrima, el cual no cuenta con verificación de antecedentes y reporte de visita.', 'Porque no se verificaron los antecedentes con anterioridad y no se verifico el reporte de la visita.\nPorque se hizo caso omiso a la verificación, y para el reporte no se realizo verificación de cumplimiento.\nPorque se delegó actividades con poco seguimiento.\n\n', 'No', '', NULL, NULL, 'Rechazada', 'No', '', NULL, NULL, NULL, NULL, '2024-06-06', '2024-06-21', 24),
(29, 'Verificación por Auditoria Interna\n', 'AI', '', 'AC', '2024-06-06 20:54:50', 'La empresa no garantiza la actualización de sus asociados de negocio como parte de la debida diligencia, afectando el numeral 1.2 del estándar BASC 6.0.2.', 'Porque no se verificaron los antecedentes con anterioridad y no se verifico el reporte de la visita. \nPorque se hizo caso omiso a la verificación, y en el reporte no se realizo verificación de cumplimiento.\nPorque se delegó actividades con poco seguimiento.\n\n', 'No', '', NULL, NULL, 'Cerrada', 'Si', 'Se realizan todas las actividades planeadas para dar ejecución a la totalidad de la acción por lo cual se cierra la presente acción de manera EFICAZ. \nNOTA: es importante que las evidencias adjuntas en cada acción sean de fácil acceso, NO SE PERMITE VINCULAR ACCESOS DIRECTOS DEL CORREO ELECTRÓNICO, YA QUE ESTOS NO PÉRMITEN SU CORRECTA VISUALIZACIÓN. por lo tanto es imperativo que se guarde el correo enviado a las PI, en formato PDF y guarde como evidencia en DRIVE, así se garantiza su visualización.\nNOTA 2: se adjunta evidencia de la actividad 72 de esta acción, ya que la proporcionada por la responsable no funciona el link de acceso adjunto.\nhttps://drive.google.com/file/d/19nXeX9fcY2q8Yq2Jj2djTkPcn3s6Q6H6/view?usp=sharing', 'No', 'N/A', 'No', 'N/A', '2024-08-05', '2024-06-21', 24),
(30, 'Verificación por Auditoria Interna', 'AI', '', 'AC', '2024-06-11 17:42:38', 'En la auditoría interna realizada el 24 de mayo, se evidenció que el área técnica no estaba realizando las copias de seguridad en el día correspondiente. Además, desde el mes de abril no se contaba con ninguna copia de seguridad.', '• Porque no existía un sistema automatizado para realizar las copias de seguridad. <br>\n• Porque no se había implementado un script o software que automatizara el proceso de copia de seguridad. <br>\n• Porque no había un desarrollo o adquisición de tal herramienta en la planificación de Gestión TI. <br>\n• Porque no se consideró la automatización de las copias de seguridad como una prioridad en la estrategia. <br>\n• Porque se subestimó la importancia de las copias de seguridad automatizadas y se confió en que los colaboradores realizarían esta tarea de manera consistente. <br>', '', '', NULL, NULL, 'Cerrada', 'Si', 'Se ejecutan todas las actividades propuestas en el plan de trabajo de la AC, cumpliendo con su objetivo, con lo cual se garantiza ejecución del BACK-UP de la información de los colaboradores, de manera automática, sin embargo es importante que se haga seguimiento durante un periodo prudente a fin de garantizar la confiabilidad de la herramienta. Se cierra de manera EFICAZ la presente AC.', 'No', 'N/A', 'Si', 'Se debe describir la funcionalidad de la herramienta de manera documental, ya sea en el manual de TI o en la política de  uso de recursos de la información.', '2024-06-12', '2024-07-01', 2),
(31, 'Reunión con la Gerencia', 'AI', '', 'AC', '2024-06-11 18:06:07', 'Se identifica un incumplimiento a requisito legal relacionado con la resolución de 3313 del 16 de junio 2022, sobre la radicación del permiso de vertimientos y ocupación de causes otorgado por  la CARDER,  la cual indicó, en su momento, que se otorga el permiso por espacio de 10 años, sin embargo se otorga 1 año mientras se finiquitaba la construcción de la PTAR,  plazo que termino el 16 de junio de 2023 y a la fecha no se ha notificado a la CARDER, que la construcción de la PTAR y de su descole ha finalizado, lo que se traduce en un posible riesgo de revocatoria del permiso otorgado, lo cual afectaría los tratamiento de aguas del los usuarios instaladas en la ETAPA 2 de ZFIP.', '\n1) Porque se omite darle seguimiento a los documentos de origen externo que afectan el SG y a la empresa por parte de los diferentes procesos responsables.<br>                                                                                                                                   \n2)  Porque no se monitorean los controles de manera adecuada y suficiente  frente a la actualización de este documento y de los requisitos que éste pretende rastrear. <br>                                                                                                                  \n3)  Porque no se establece, documentan y trasladan ESPECÍFICAMENTE  las responsabilidades trasversales del SG a los diferentes líderes o responsables de los procesos.<br>', 'Si', 'Durante el año 2023, se identifica una omisión a otra resolución de la CARDER, la cual requería su renovación, en el proceso técnico y se omitió realizarla, no llegó a sanción pero el riesgo de omisión se materializó', NULL, NULL, 'Cerrada', 'Si', 'Se efectuaron todas las actividades del plan de trabajo propuesto para tal fin, por lo tanto se cierra\nla presente acción de manera EFICAZ.', 'Si', 'Se anexa en la matriz de riesgos el riesgo de \"Incumplimiento de requisitos legales consignados\nen el listado maestro de documentos externos\".', 'No', 'N/A', '2024-07-04', '2024-07-31', 17),
(32, 'En auditoria interna realizada el dia 20 de mayo del 2024, en verificacion de las hojas de vida de los guardas de seguridad adsquitros a la empresa Seguridad Nacional.', 'AI', '', 'AC', '2024-06-12 20:35:50', 'Se evidencia que en las hojas  de vida de los guardas Carolina Gomez esta vencido el certificado de Simetrica (aptitud), Juan Pablo Giraldo Castañeda tenia vencido el certifado de Simetrica (aptitud), sin actualizar desde el año 2022, certificado de reentrenamiento vencido desde el 08 de mayo del 2024 y al Guarda de seguridad Oscar Cardona no se tenia fisico ni magnetico el certificado de Simetrica (aptitud).', 'Porque nó se tenia actualizadas las carpetas con las hojas de vida.\nPorque la empresa contratada no habia enviado los certificados debidamente actualizados.\nPorque no se habia ejercido el control suficiente con la empresa contratada.', 'No', '', NULL, NULL, 'Rechazada', 'Si', NULL, 'No', 'N/A', 'Si', 'Se debe describir la funcionalidad de la herramienta de manera documental, ya sea en el manual de TI o en la política de  uso de recursos de la información.', '2024-06-12', '2024-06-20', 59),
(34, 'En auditoria interna realizada el dia 20 de mayo del 2024, en verificacion de las hojas de vida de los guardas de seguridad adsquitros a la empresa Seguridad Nacional.', 'AI', '', 'AC', '2024-06-13 13:28:30', 'Se evidencia que en las hojas de vida de los guardas Carolina Gomez esta vencido el certificado de Simetrica (aptitud), Juan Pablo Giraldo Castañeda tenia vencido el certifado de Simetrica (aptitud), sin actualizar desde el año 2022, certificado de reentrenamiento vencido desde el 08 de mayo del 2024 y al Guarda de seguridad Oscar Cardona no se tenia fisico ni magnetico el certificado de Simetrica (aptitud).\n', 'Porque nó se tenia actualizadas las carpetas con las hojas de vida. <br>\nPorque la empresa contratada no habia enviado los certificados debidamente actualizados. <br>\nPorque no se habia ejercido el control suficiente con la empresa contratada.', 'No', '', NULL, NULL, 'Cerrada', 'Si', 'Se realizan todas las actividades planteadas para la AC, y se implementa control al seguimiento de las hojas de vida por parte del Jefe de Seguridad, logrando el objetivo de la acción levantada, por lo tanto se cierra de manera eficaz la presente AC.', 'No', 'N/A', 'Si', 'Es necesario que la metodología quede trazada dentro de procedimiento de seguridad, así se garantiza el control cuando se cambie de persona responsable del control implementado.', '2024-06-13', '2024-06-20', 59),
(35, 'En auditoria interna realizada el dia 20 de mayo del 2024, en verificacion de de la  Politica de Uso y Custodia de Recursos de Seguridad V5 PR-PH-02.', 'AI', '', 'AC', '2024-06-13 17:19:02', 'Se evidencia el incumplimiento de la política de recursos de seguridad, ya que no se esta haciendo actualización debida del inventario de recursos ni se esta diligenciando el formato de movimiento de recursos al momento de préstamos de los mismos.', '• Porque: se tenia una confusión con el inventario general y la asignación de recursos, adicional el control de préstamos se estaba haciendo por correo. <br>\n• Porque tanto el inventario como la metodología de prestamos no eran actividades rutinarias.<br>\n• Porque no se tenia pleno entendimiento de la politica de uso y custodia de recursos ademas no se habia incluido la nueva metodología de prestamo.<br>', 'No', '', NULL, NULL, 'Cerrada', 'Si', 'Se evidencia plan de trabajo completamente ejecutado, lo que garantiza la eficacia de la acción, por lo tanto se cierra con estado EFICAZ la presente acción.', 'No', 'N/A', 'Si', 'Actualizar la política de uso y custodia de recursos de seguridad, actividad que ya esta ejecutada dentro del plan de trabajo.', '2024-06-21', '2024-06-20', 59),
(36, 'Auditoria Interna', 'AI', '', 'AM', '2024-06-17 19:37:37', 'Se observa en el procedimiento documentado MA-JU-02 (Manual SIPLA) V7 del 25 enero de 2024, que se tiene implementado el reporte de\noperaciones sospechosas, sin embargo no se describe textualmente el proceso de comunicación para Reporte de operaciones sospechosas\ncon: Asociados de negocio, Vehículos, Sellos, Documentación, así como documentación de las señales de alerta identificadas durante\ncualquier proceso de actualización con asociados de negocio.', 'N/A (Oportunidad de Mejora)', 'No', '', NULL, NULL, 'Cerrada', 'Si', 'Se observa plan de trabajo efectuado en su totalidad, por lo tanto se cierra la presente acción de manera EFICAZ.', 'No', 'N/A', 'Si', 'Actualización del manual SIPLA', '2024-06-28', '2024-06-18', 24),
(37, 'OBSERVACIÓN. DILIGENCIAMIENTO CON TACHONES Y/O ENMENDADURAS EN FORMATO DE LISTA DE CHEQUEO DE BÁSCULAS FO-TC-04 DURANTE AUDITORÍA INTERNA.', 'AI', '', 'AC', '2024-06-18 17:14:53', 'Al validar el registro de lista de chequeo de básculas, se observa diligenciado a mano, con presencia de tachones en el mismo, indicando un posible incumplimiento al numeral 7.2.4 literal C de la norma BASC y 7.5.3. D. de la norma ISO 9001:15.', 'La presencia de tachones en los registros de lista de chequeo de básculas está influenciada principalmente por la presión por tiempo, la falta de planificación adecuada de la carga de trabajo, la capacitación insuficiente, así como la falta de recordatorios efectivos para completar los registros a tiempo. Estos factores combinados contribuyen a errores en el diligenciamiento de los registros, destacando la necesidad de fortalecer la capacitación y los sistemas de recordatorios para garantizar la precisión y la integridad en la documentación.', 'Si', 'Dado que el diligenciar formatos es una actividad rutinaria y transversal a todos los procesos, es posible que estos errores en el diligenciamiento de formatos también se presenten en otras áreas o procedimientos.', NULL, NULL, 'Cerrada', 'Si', 'Se observa efectuada la totalidad de las actividades del plan de acción, por lo tanto se cierra la presente  acción de manera EFICAZ. Se recomienda velar por mantener las buenas prácticas en el diligenciamiento de los formatos, bajo el manejo de su personal a cargo y partes involucradas en el proceso.', 'No', 'N/A', 'No', 'N/A', '2024-06-21', '2024-06-18', 14),
(38, 'Informe de auditoria interna ', 'AI', '', 'AC', '2024-06-18 20:53:51', 'La empresa no garantiza evaluar la criticidad de todos los cargos, así como tampoco tiene en cuenta los cambios organizacionales que se han dado a lo largo del tiempo ni su impacto en la criticidad y la gestión de riesgos, ya que se observa que la matriz de evaluación de cargos críticos esta desactualizada desde el 2020.', 'Porque no tenia claro, que cuando se actualiza el organigrama se debe actualizar la Matriz de Cargos Criticos.\r\nPorque no tenia conocimiento de la matriz dentro del proceso.\r\n\r\nPorque no conocia la importancia de dicha matriz dentro de los docuementos cargado en SADOC.\r\n\r\nPorque por falta de verificacion y auditoria de los docuementos pertenecientes al proceso, se tenia desactualizada la matriz.\r\n\r\nPorque puede haber una falta de conciencia o reconocimiento dentro de la organización sobre la importancia crítica de verificar y auditar regularmente los documentos para mantener la precisión y relevancia de la matriz.\r\n', 'No', '', NULL, NULL, 'Cerrada', 'Si', 'Se observa ejecución del plan de trabajo completamente, se cierra la presente acción de manera EFICAZ', 'No', 'N/A', 'No', 'N/A', '2024-06-21', '2024-08-30', 27),
(41, 'Observacion de Auditoria Interna Seguridad del dia  20 de mayo de 2024', 'AI', '', 'AM', '2024-06-19 14:52:40', 'La empresa no ha considerado realizar las inspecciones al 100% de vehículos que entran y salen de la instalación.\n', 'Porque el personal de guardas de seguridad no se ha concientizado de la importancia de la totalidad de requisas.\r\nPorque el personal de las diferentes empresas instaladas en la ZFIP, no son consientes de la importancia de permitir las requisas al momento del ingreso y salida.\r\nPorque en las horas picos, la cantidad de personal de las diferentes empresas instaladas en la ZFIP es mucho para el numero de personas que realizan esta actividad.\r\nPorque no se tiene una supervisión continua para asegurar que las requisas se lleven a cabo correctamente y de manera consistente.\r\n', 'No', '', NULL, NULL, 'Cerrada', 'Si', 'Se realizaron todas las actividades propuestas para la presente acción, por lo tanto se cierra de manera eficaz', 'No', 'n/a', 'No', 'n/a', '2024-10-16', '2024-05-21', 59),
(42, 'Revisión de Resoluciones CARDER - Reunión de gerencia', 'AI', 'Revisión de documentos', 'AC', '2024-06-19 19:46:11', 'Incumplimiento del artículo segundo de la Resolución CARDER 3313 del 16 de junio de 2022 por la cual se aprueba la construcción de una PTARD y se otorga un plazo de un (1) año para notificar de su construcción, plazo que venció el 16 de junio de 2022 y no se notificó en el plazo establecido. Esta omisión puede provocar la revocatoria del permiso de vertimientos otorgado, reflejándose en la imposibilidad de prestar el servicio de tratamiento de aguas residuales a las empresas instaladas en la etapa 2 de ZFIP.', '1) porque no se hizo seguimiento de la Resolución en cuestión. 2) porque no se actualizó el documento en el Listado Maestro de Documentos Externos. 3) porque no se socializó específicamente la responsabilidad para actualizar y verificar la adición de las nuevas normas. 4) porque no hubo una revisión periódica en los procedimientos internos para asegurar la actualización del listado. 5) porque no hay un calendario de actualización y/o verificación del documento.', 'Si', 'El Listado Maestro de Documentos Externos es crucial dado que abarca todos los procesos empresariales, incluyendo normativas, conceptos técnicos, resoluciones y otros requisitos obligatorios; por lo que existe la posibilidad de que no se esté realizando un seguimiento adecuado a otros documentos relevantes que podrían impactar a la empresa.', NULL, NULL, 'Rechazada', 'No', '', NULL, NULL, NULL, NULL, '2024-06-19', '2024-06-19', 14),
(43, 'En auditoria interna realizada el 20 de mayo del 2024. Vegetacion.', 'AI', '', 'AC', '2024-06-20 21:02:06', 'En revision por parte de la auditoria se evdencia el estado de la vegetacion alto y falta de mantenimiento, contribuyendo a la mala visibilidad de CCTV y difícil identificación de intrusos por este sector.', 'Porque el área de seguridad no tiene un presupuesto asignado.\nPorque depende de la programación y disponibilidad del área técnica.\nPorque el área técnica es la encargada del mantenimiento en general de la etapa 2.\nPorque el mantenimiento se reprogramo para el día 25 de mayo del 2024.\nPorqué el contratista cancelo de manera imprevista el mantenimiento programado. \n\n\n\n', 'No', '', NULL, NULL, 'Rechazada', 'No', '', NULL, NULL, NULL, NULL, '2024-06-20', '2024-08-30', 59),
(44, 'En auditoria interna realizada el 20 de mayo del 2024. Vegetacion.', 'AI', '', 'AP', '2024-06-21 14:32:46', 'En revision por parte de la auditoria se evdencia el estado de la vegetacion alto y falta de mantenimiento, contribuyendo a la mala visibilidad de CCTV y difícil identificación de intrusos por este sector.', '1).Porque los tiempos de mantenimientos (periodicidad) no estan bien calculados.  2 ).Porque no se tiene en cuenta los tiempos o estado del clima (lluvia).  3).Porque los mantenimientos estam programados de manera mensual.', 'No', '', NULL, NULL, 'Abierta', 'Si', 'Se realizan todas las actividades programadas para la presente acción, por lo tanto se cierra de manera EFICAZ', 'No', 'N/A', 'No', 'N/A', '2024-09-25', '2024-08-31', 1087561072),
(45, 'Revisiòn de trànsitos manuales debidamente finalizados en el periodo de abril.', 'Otros', ' Durante la revisiòn de los trànsitos manuales evidenciamos que el tránsito 15629002648907,no se finalizò de forma manual dentro del plazo establecido debido a que , no contábamos con un control sobre las autorizaciones y seguimiento a las repuestas de la DIAN para poder hacer el proceso de cierre.', 'AC', '2024-07-05 21:44:35', 'Se evidenciò que el tránsito 15629002648907,no se finalizò de forma manual dentro del plazo establecido debido a que , no contábamos con un control sobre las autorizaciones y seguimiento a las repuestas de la DIAN para poder hacer el proceso de cierre.', '1-Se encontrò el tránsito sin finalizar  nùmero 15629002648907.\n2-El correo solicitando la autorizaciòn para finalizar  a la DIAN , fue enviado por el analista que estaba de turno en la ventanilla  y al dìa siguiente no se percataron de que la respuesta había sido  comunicada a este único analista, que en su momento estaba en ventanilla y no realizò el seguimiento correspondiente al ya no encontrarse al dìa siguiente en la ventanilla y dejó pasar los tiempos sin reportarle  la autorizaciòn al coordinador de OP para hacer la finalizaciòn correspondiente.\n3-No se tenía  como persona responsable de seguimiento a estas respuesta de la DIAN al funcionario que hacía directamente  la solicitud  ,el responsable era el del turno de la ventanilla lo que permitiò que por cambio de turno , no se hiciera seguimiento al correo,ya que el funcionario DIAN solo respondiò al remitente del correo, no copio a todos los analistas de OP.\n4-Al solo responderse a un contacto de OP por parte de la DIAN, los demás funcionarios asumieron que no había autorizaciòn todavía para finalizar el trànsito.\n', 'No', '', NULL, NULL, 'Cerrada', 'Si', 'Se realiza la actividad planteada para subsanar la NC, por lo tanto se cierra de manera eficaz la presente acción.\nRECOMENDACIÓN:\nRecuerde que las AC se componen de:\n1) Descripción del HALLALZGO\n2) Análisis de Causas\n3) Corrección (actividad que corrige el hallazgo, pero no me ataca la causa raíz).\n4) Acción correctiva o plan de acción (conjunto de actividades que subsana la causa raíz del hallazgo y garantiza que no vuelva a ocurrir).\nPara el caso de la presente acción faltó levantar la corrección, pues no quedó descrita en ninguna parte en el informe.\nEs de recordar que el diligenciamiento incompleto de las acciones es causal de rechazo, por lo tanto es imperativo se siga la presente recomendación y se cumplan los componentes de las acciones a cabalidad. ', 'No', 'N/A', 'No', 'N/A', '2024-07-29', '2024-07-08', 7),
(46, 'Se identifica la necesidad de incluir los Títulos de Devolución de Impuestos - TIDIS en el listado maestro de documentos externos, con el fin de establecer recordatorios y sistemas para evitar el riesgo de perdida de fondos por vencimiento.\n', 'AI', '', 'AP', '2024-08-26 02:58:29', 'Establecer el procedimiento necesario para negociar Títulos antes del vencimiento dependiendo de los flujos de caja. Se recomienda incluir en calendarios del área, establecer alertas electrónicas, y tener en cuenta en flujos de caja en el aparte de obligaciones fiscales; así mismo, incluir los Títulos de Devolución de Impuestos - TIDIS en el listado maestro de documentos externos, con el fin de establecer recordatorios y sistemas para evitar el riesgo de perdida de fondos por vencimiento.', 'No contar con el registro de los Títulos de Devolución de Impuestos - TIDIS en el listado de documentos externos, no contar con la descripción de los títulos los recursos de efectivo y en los manuales del área. No contar con un procedimiento en el área que establezca como y cuando negociar los TIDIS dentro de la empresa.', 'No', '', 'Incluir los Tidis en el listado Maestro de documentos externos y en los calendarios tributarios.', '2024-12-15', 'Rechazada', '', '', NULL, NULL, NULL, NULL, '2024-08-26', '2024-12-15', 6),
(47, 'Situación de riesgo presentada respecto a los fondos disponibles representados en Títulos de Devolución de Impuestos – TIDIS', 'Otros', 'Situación de riesgo presentada respecto a los fondos disponibles representados en Títulos de Devolución de Impuestos – TIDIS', 'AP', '2024-08-29 19:38:29', 'Se identifica la necesidad de incluir los Títulos de Devolución de Impuestos – TIDIS dentro del listado de documentos externos del área con el fin de monitorear su vencimiento;  así mismo, documentar el procedimiento para transformar los recursos a efectivo y/o negociar con otras empresas para el pago de impuestos.', 'No se hace trazabilidad al documento externo que reglamenta los  Títulos de Devolución de Impuestos – TIDIS otorgados a Zona Franca. NO se realiza por omisión del área responsable, por falta de capacitación y actualización del personal responsable sobre el manejo de las TIDIS. ', 'No', '', NULL, NULL, 'Abierta Vencida', 'No', '', NULL, NULL, NULL, NULL, '2024-08-29', '2024-12-31', 6),
(48, 'COMISIÒN DE  DOS INFRACCIONES ADUANERA  POR PARTE DE UN ANALISTA DE OPERACIONES ', 'Otros', '', 'AC', '2024-09-06 21:15:45', 'EL DÌA 16 DE JULIO  DEL 2024,SE PERMITIÒ LA SALIDA DE UNA MERCANCIA SIN EL CUMPLIMIENTO TOTAL DE LOS REQUISITOS PARA LA SALIDA DE MERCANCIAS DESDE UNA ZF AL RM  ,TODA VEZ QUE ,SE CONFUNDIÒ LA PLANILLA DE TRASLADO CON UN FORMATO CORRESPONDIENTE A UNA PLANILLA DE ENVIO,HECHO POR EL CUAL SE INCURRÌO EN DOS INFRACCIONES ADUANERAS.', '1-RECIENTE CAMBIO NORMATIVO PARA LAS OPERACIONES DESDE ZF AL RM.\n2-FALTA DE APROPIACIÒN DE LOS CAMBIOS NORMATIVOS POR PARTE DEL ANALISTA.\n3-CONFUSIÒN DEL ANALISTA EN CUANTO A LOS FORMATOS QUE CORRESPONDEN A LA OPERACIÒN .', 'No', '', NULL, NULL, 'Abierta Vencida', 'No', '', NULL, NULL, NULL, NULL, '2024-09-06', '2024-09-06', 7),
(49, 'Articulo 2.2.4.6.8 obligaciones de los empleadores, Numeral 6: Gestion de los peligros y riesgos del decreto 1072 del 2015.', 'Otros', 'Reporte de  condicion insegura.', 'AP', '2024-09-13 19:43:33', 'Se implementa la instalacion de un acrilico en el lugar que esta ubicada la cafetera, teniedo en cuneta que es un riesgo para ocasionar de manera accidental quemaduras a los colaboradores de la empresa.', '1.  Por qué se adecuó un acrílico al  lado de la greca.\n2. Por qué se consideró que había un posible riesgo de quemaduras.\n3. Por qué la superficie de la greca se calienta a altas temperaturas.\n4. Por qué se diseñó la egraca para calentar el agua a altas temperaturas sin medidas de protección adicionales.\n5. Por qué dentro de los diseños no se tenia contenplada la ubicacion de la greca.', 'No', '', NULL, NULL, 'Cerrada', 'Si', 'se realiza todas las actividades planteadas, por lo tanto se cierra de manera eficaz', 'No', 'n/a', 'No', 'n/a', '2024-09-13', '2024-09-12', 27),
(50, 'Normar BASC version 6 #  6.1 literal e, 6.1	Gestión del Riesgo\nLa empresa debe establecer un procedimiento documentado para la gestión del riesgo con base en el enfoque de procesos y su rol en la cadena de suministro. Debe asegurar el cumplimiento e incluir los siguientes elementos:\n\ne)	Respuesta a eventos:\n\n1.	Con base en la prioridad de los riesgos y en caso de materialización de los mismos, la empresa debe:\ni.	Establecer, documentar e implementar los métodos adecuados para que el impacto sea menor.\nii.	Ejecutar planes de recuperación de la seguridad y reactivación\n/ continuidad del negocio cuando aplique.\niii.	Documentar las actividades de respuesta al evento.\niv.	Aplicar acciones de mejora para asegurar que se analicen las causas, describiendo la metodología utilizada para evitar su recurrencia.\nv.	Retroalimentar la gestión del riesgo con las acciones y controles relacionados a los riesgos implicados.\n2.	Con base en el impacto y naturaleza del evento, se deben realizar ejercicios prácticos y/o simulacros, que permitan determinar la eficacia de las acciones establecidas.', 'Otros', 'De la implementacion del  Comite Operativo de Emergencia (COE)  por parte de SST en articulacion con la Norma BASC  version 6, quedando como Comite Operativo de Emergencia en Crisis (COEC) ', 'AM', '2024-09-16 15:35:05', 'Se observa la posibilidad de vinculacion de del plan de continuidad de negocio y manual de preparacion y atencion a respuesta de eventos, acorde a la integracion del comite operativo de emergencias con el SIG', 'N/A', 'No', '', NULL, NULL, 'Cerrada', 'Si', 'Se efectuaron todas las actividades planteadas para la acción, por lo tanto se cierra de manera EFICAZ.', 'No', 'N/A', 'No', 'N/A', '2024-09-25', '2024-09-30', 27),
(51, 'LEY 1581 DE 2012 del TÍTULO VI, Articulo 17 numeral k', 'Otros', 'Capacitación de protección de datos personales (BASC) ', 'AM', '2024-10-02 16:47:48', 'Se implementará un procedimiento de protección de datos personales para garantizar el adecuado cumplimiento de la Ley 1581 de 2012', '', 'No', '', NULL, NULL, 'Cerrada', 'Si', 'Se efectúa todas las actividades planteadas para la AM , por lo cual se cierra de manera eficaz', 'No', 'N/A', 'No', 'N/A', '2024-10-28', '2024-10-30', 24),
(52, 'Ley 594 del 2000 Por medio de la cual se dicta la Ley General de Archivos y se dictan otras disposiciones', 'Otros', 'Surge de la necesidad en implementar la ley 594 del 2000, la cual establece la adecuada recepcion y conservacion de los docuemntos.', 'AM', '2024-10-03 15:46:51', 'Se realizara el cambio de las unidades de conservacion, de carpetas AZ a carpetas cuatro aletas, cajas X-200 con su respectiva foliacion (maximo 230 folios por carpeta).', 'N/A', 'No', '', NULL, NULL, 'Abierta Vencida', 'No', '', NULL, NULL, NULL, NULL, '2024-10-03', '2024-12-30', 27),
(53, 'ALTAS TEMPERATURAS EN EL ÁREA DE OPERACIONES, REPORTE REALIZADO POR MÚLTIPLES ANALISTAS Y LA DIRECCIÓN DE OPERACIONES.', 'Otros', 'REPORTE DE COLABORADORES DEL ÁREA DE OPERACIONES', 'AC', '2024-10-09 16:56:53', 'Mejorar el confort térmico en las oficinas de trabajo del área de Operaciones para abordar las altas temperaturas que afectan la comodidad y productividad de los colaboradores.\n Las altas temperaturas, causadas por la radiación solar directa y un aire acondicionado insuficiente, generan incomodidad y estrés en el personal. La instalación de un nuevo sistema de aire acondicionado busca corregir esta situación.', 'Radiación solar directa: La presencia de múltiples ventanales permite la entrada de luz solar directa, aumentando la temperatura interna.\nUbicación geográfica: El clima de la zona puede ser caluroso, lo que contribuye al aumento de temperatura en espacios cerrados.\nAire acondicionado insuficiente: El sistema de aire acondicionado actual no es capaz de mantener una temperatura confortable debido a su capacidad limitada para el tamaño del área y la cantidad de personal.\nAlta densidad de personal: La cantidad elevada de colaboradores en un espacio reducido genera un aumento en la temperatura debido a la acumulación de calor corporal.', 'No', '', NULL, NULL, 'Cerrada', 'Si', 'Se realizan todas las actividades planteadas para esta acción, por lo tanto se cierra de manera eficaz', 'No', 'n/a', 'No', 'n/a', '2024-10-15', '2024-10-11', 14),
(54, 'RXD', 'Otros', 'Comité de Gerencia', 'AM', '2024-10-11 16:32:58', 'Como respuesta a la decisión de no continuar con la certificación de la norma ISO 28000, la Gerencia sugiere implementar la metodología de Gobierno Corporativo para la empresa, teniendo en cuenta que esta metodología establece políticas de prevención de LA/FT y transparencia.', '', 'No', '', NULL, NULL, 'Abierta Vencida', 'No', '', NULL, NULL, NULL, NULL, '2024-10-11', '2024-12-31', 17),
(55, 'RXD', 'Otros', 'Comité de Gerencia', 'AM', '2024-10-15 13:49:48', 'Durante uno de los comités de gerencia se identifica que la plataforma estratégica de la empresa estaba incompleta, pues se determinan todas las fuentes de trabajo, sin embargo no se estable su plan estratégico que permita lograr en un periodo de tiempo determinado los objetivos estratégicos y de proceso, así  como la visión de la empresa.', '', 'No', '', NULL, NULL, 'Abierta Vencida', 'No', '', NULL, NULL, NULL, NULL, '2024-10-15', '2024-12-20', 17),
(56, 'Análisis de norma BASC - revisión del proceso', 'Otros', 'Análisis de norma BASC', 'AP', '2024-10-15 14:52:39', 'En revisión de los conceptos de la norma BASC, se identifica la necesidad de estructurar el paso a paso de construcción de los requisitos contenidos en el numeral 4.', 'Porque no se cuenta con paso a paso o instructivo de elaboración de los requisitos del punto 4.\nPorque se pensaba que con la descripción contenida en el manual integrado de gestión, se cumplía con la exigencia.\nPorque se omitía la necesidad de explicitud en estos requisitos.', '', '', NULL, NULL, 'Abierta Vencida', 'No', '', NULL, NULL, NULL, NULL, '2024-10-15', '2024-12-20', 17),
(57, 'AUDITORIA EXTERNA ISO 9001:15', 'AE', '', 'AC', '2024-10-15 15:53:42', 'La organización no asegura la implementación de los nuevos cambios de la enmienda de la norma sobre cambio climático, se incumple parcialmente el requisito 4.1 y 4.2 de la norma ISO 9001:15\nSe verifica contexto de la organización y partes interesadas per a la fecha no se han considerado los cambios respecto a la enmienda sobre cambio climático de la norma ISO 9001:15, de declara menor por incumplimiento parcial a requisito.', '* Porque la organización no ha considerado los cambios respecto a la enmienda sobre el cambio climático de la norma ISO 9001:15.\n* Porque la organización y los responsables de los SG, apenas conocieron las directrices relacionadas en la citada enmienda, días antes de la auditoria externa.\n* Porque la difusión por parte de los entes certificadores no fue lo suficientemente efectiva, lo que dificultó incluir, en oportunidad, en el contexto y PI, el análisis de las repercusiones que la organización tiene  hacia el cambio climático y viceversa.', 'No', '', NULL, NULL, 'Abierta Vencida', 'No', '', NULL, NULL, NULL, NULL, '2024-10-15', '2024-10-31', 17),
(58, 'prueba', 'AI', '', 'AM', '2024-10-18 16:47:40', '1', '1', 'No', '', NULL, NULL, 'Rechazada', 'No', '', NULL, NULL, NULL, NULL, '2024-10-18', '2024-10-18', 24),
(59, 'En virtud del parágrafo 3º del artículo 2º de la Ley 901 de 2004, y del numeral 5º del Art 2º de la Ley 1066 de 2006', 'Otros', 'Reunión con consultorio Basc', 'AP', '2024-10-18 17:38:53', 'Se observa en el procedimiento PR-JU-04 PROCEDIMIENTO DE ASOCIADO DE NEGOCIOS V1, que se tiene implementado la verificación de antecedentes, sin embargo no se tiene la consulta de verificación de reporte del BDME Boletín de Deudores Morosos del Estado. ', 'Por qué no se realiza la consulta en el BDME?\nPorqué no se tenia contemplado en el procedimiento \nPorqué no se tenia el suficiente conocimiento de esta herramienta \nPorqué no se incluyo una actualización en relación a fuentes de información\nPorqué se ha confiado en las herramientas tradicionales de verificación, sin explorar nuevas fuentes como el BDME.\n\n', 'No', '', NULL, NULL, 'Abierta Vencida', 'No', '', NULL, NULL, NULL, NULL, '2024-10-18', '2024-12-20', 24),
(60, 'Norma Internacional Basc numeral 6.2', 'Otros', '', 'AM', '2024-10-18 21:31:10', 'En la identificación de mejora del proceso se origina la necesidad de digitalizar las solicitudes legales realizadas por los lideres de proceso, mediante plataforma de ZF. ', '', 'No', '', NULL, NULL, 'Cerrada', 'Si', 'Se realizan todas las actividades propuestas, por lo cual se cierra de manera EFICAZ la presente acción.', 'No', 'N/A', 'No', 'N/A', '2024-11-08', '2024-12-20', 24),
(61, 'Hallazgos realizados por la DIAN en auditoria realizada para la solicitud de Devolución de Renta año 2023', 'AE', '', 'AP', '2024-10-29 21:25:29', 'Hallazgos realizados por la DIAN en auditoria de solicitud de Devolución de Renta año 2023', 'Ausencia de controles y omisión en la revisión en el envió de documentos soporte electrónicos y eventos', 'No', '', NULL, NULL, 'Cerrada', 'Si', 'se realizan todas las actividades por lo tanto se cierra eficaz', 'No', 'n/a', 'No', 'n/a', '2024-10-31', '2024-12-31', 6),
(96, 'PRUEBA', 'AI', '', 'AM', '2024-11-20 15:56:33', 'PRUEBA', 'PRUEBA', 'No', '', '', '0000-00-00', 'Abierta Vencida', 'No', '', NULL, NULL, NULL, NULL, NULL, '2024-11-20', 1087561072);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acpm_rechazada`
--

CREATE TABLE `acpm_rechazada` (
  `id_rechazada` int(11) NOT NULL,
  `fecha_rechazo` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `descripcion_rechazo` text NOT NULL,
  `id_consecutivo_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades_acpm`
--

CREATE TABLE `actividades_acpm` (
  `id_actividad` int(11) NOT NULL,
  `fecha_actividad` date DEFAULT NULL,
  `descripcion_actividad` text DEFAULT NULL,
  `tipo_actividad` enum('Correccion','Actividad') DEFAULT NULL,
  `estado_actividad` enum('Completa','Incompleta') DEFAULT NULL,
  `id_usuario_fk` int(11) DEFAULT NULL,
  `id_acpm_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activos`
--

CREATE TABLE `activos` (
  `id_activo` int(11) NOT NULL,
  `cod_renta` varchar(100) NOT NULL,
  `fecha_asignacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nombre_articulo` varchar(300) NOT NULL,
  `descripcion_articulo` text NOT NULL,
  `modelo_articulo` varchar(200) DEFAULT NULL,
  `referencia_articulo` varchar(200) DEFAULT NULL,
  `marca_articulo` varchar(300) DEFAULT NULL,
  `tipo_articulo` text DEFAULT NULL,
  `lugar_articulo` text DEFAULT NULL,
  `observaciones_articulo` text DEFAULT NULL,
  `numero_factura` float DEFAULT NULL,
  `fecha_garantia` date DEFAULT NULL,
  `valor_articulo` float DEFAULT NULL,
  `condicion_articulo` text DEFAULT NULL,
  `id_proveedor_fk` int(11) DEFAULT NULL,
  `descripcion_proveedor` text DEFAULT NULL,
  `id_usuario_fk` int(11) DEFAULT NULL,
  `estado_activo` enum('Activo','Inactivo','Rentado','Dar de Baja','En Almacenamiento') NOT NULL,
  `recurso_tecnologico` enum('Si','No','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `activos`
--

INSERT INTO `activos` (`id_activo`, `cod_renta`, `fecha_asignacion`, `nombre_articulo`, `descripcion_articulo`, `modelo_articulo`, `referencia_articulo`, `marca_articulo`, `tipo_articulo`, `lugar_articulo`, `observaciones_articulo`, `numero_factura`, `fecha_garantia`, `valor_articulo`, `condicion_articulo`, `id_proveedor_fk`, `descripcion_proveedor`, `id_usuario_fk`, `estado_activo`, `recurso_tecnologico`) VALUES
(182326, 'No Aplica', '2024-07-12 19:19:10', 'PC', 'LENOVO', 'LENOVO', 'AS8745', 'LENOVO', 'COMUNCACIONES', 'PISO 2', 'JJJ', 0, '2024-07-05', 951025, 'SSS', 1087561072, 'SS', 2, 'Activo', 'Si'),
(182327, 'No Aplica', '2024-07-12 19:19:11', 'PC', 'LENOVO', 'LENOVO', 'AS8745', 'LENOVO', 'COMUNCACIONES', 'PISO 2', 'JJJ', 0, '2024-07-05', 951025, 'SSS', 1087561072, 'SS', 2, 'Activo', 'Si'),
(182328, 'No Aplica', '2025-01-16 12:53:26', 'PC', 'LENOVO', 'LENOVO', 'AS8745', 'LENOVO', 'COMUNCACIONES', 'PISO 2', 'JJJ', 0, '2024-07-05', 951025, 'SSS', 1087561072, 'SS', 10, 'Activo', 'Si'),
(182329, 'No Aplica', '2024-07-12 19:19:12', '1', '1', '1', '1', '1', '1', '1', '1', 1, '0001-01-01', 1, '1', 1, '1', 2, 'Activo', 'Si'),
(182330, 'No Aplica', '2024-07-12 19:19:13', '1', '1', '1', '1', '1', '1', '1', '1', 1, '0011-01-01', 2, '11', 1, '1', 2, 'Activo', 'Si'),
(182331, 'No Aplica', '2024-07-12 19:19:14', '952', '222', '22', '2', '2', '2', '2', '2', 22, '2024-07-05', 66, '6', 1087561072, '212', 2, 'Activo', 'Si'),
(182332, 'No Aplica', '2024-07-12 19:19:15', '1111', '1', '1', '1', '1', '1', '1', '1', 1, '0001-01-01', 1, '1', 1, '1', 2, 'Activo', 'Si'),
(182333, 'No Aplica', '2024-07-12 19:19:16', '1111', '1', '1', '1', '1', '1', '1', '1', 1, '0001-01-01', 1, '1', 1, '1', 2, 'Activo', 'Si'),
(182334, 'No Aplica', '2024-07-12 19:19:16', 'nuevo', '4', '4', '4', '4', '4', '4', '4', 4, '2024-07-10', 55, '5', 1087561072, '554', 2, 'Activo', 'Si'),
(182335, 'No Aplica', '2024-07-12 19:19:17', 'nuevo', '4', '4', '4', '4', '4', '4', '4', 4, '2024-07-10', 55, '5', 1087561072, '554', 2, 'Activo', 'Si'),
(182336, 'No Aplica', '2024-07-12 19:19:18', 'caja fuerte', '1', '1', '1', '1', '1', '1', '1', 1, '2024-07-10', 4, '4', 1087561072, '111', 2, 'Activo', 'Si'),
(182337, 'No Aplica', '2024-07-12 19:19:19', 'nuevo bd nuve', 'nuevo bd nuve', '1', '2', '3', '5', '6', '54', 654, '2024-12-31', -1, '2', 1087561072, '848', 2, 'Activo', 'Si'),
(182338, 'No Aplica', '2024-07-15 15:34:44', 'ACTIVO DIFERENTE', 'ACTIVO DIFERENTE', 'ACTIVO DIFERENTE', 'ACTIVO DIFERENTE', 'ACTIVO DIFERENTE', 'ACTIVO DIFERENTE', 'ACTIVO DIFERENTE', 'ACTIVO DIFERENTE', 0, '2024-07-15', 888, '888', 1087561072, 'ACTIVO DIFERENTE', 2, 'Activo', 'Si'),
(182339, 'No Aplica', '2024-08-23 15:16:55', 'hj', 'hj', 'hj', 'hj', 'hj', 'hj', 'hj', 'hj', 0, '2024-08-23', 14, '545', 1087561072, 'hj', 117, 'Activo', 'Si'),
(182340, 'No Aplica', '2024-08-23 15:18:06', '545', '45', '45', '4', '54', '54', '54', '5', 54, '2024-08-23', 45, '4', 1087561072, 'fdf', 1, 'Activo', 'Si'),
(182341, 'No Aplica', '2025-01-16 12:50:25', 'Televisor 60', '1', '1', '1', '1', '1', '1', '1', 1, '2025-01-20', 1, '1', 1087561072, '1', 10, 'Activo', 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actualizacion_pw`
--

CREATE TABLE `actualizacion_pw` (
  `id_pw` int(11) NOT NULL,
  `nombre_app` varchar(200) NOT NULL,
  `usuario_app` varchar(200) NOT NULL,
  `pw_app` text NOT NULL,
  `id_pw_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `actualizacion_pw`
--

INSERT INTO `actualizacion_pw` (`id_pw`, `nombre_app`, `usuario_app`, `pw_app`, `id_pw_fk`) VALUES
(1, '1', '1', 'c4ca4238a0b923820dcc509a6f75849b', 1),
(2, '1', '1', 'c4ca4238a0b923820dcc509a6f75849b', 1),
(3, '1', '1', 'c4ca4238a0b923820dcc509a6f75849b', 1),
(4, '1', '1', 'c4ca4238a0b923820dcc509a6f75849b', 1),
(5, '1', '1', 'c4ca4238a0b923820dcc509a6f75849b', 2),
(6, '56', '56', '9f61408e3afb633e50cdf1b20de6f466', 3),
(7, '56', '56', '9f61408e3afb633e50cdf1b20de6f466', 3),
(8, 'Correo', 'yrios@gmail.com', '12844aad9ac565cb3761c16612373ea7', 4),
(9, 'Sadoc', 'yrios@gmail.com', '077129c6f170eba8b57e810caffd6d53', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_equipos`
--

CREATE TABLE `asignacion_equipos` (
  `id_asignacion` int(11) NOT NULL,
  `fecha_asignacion` date NOT NULL,
  `estado_asignacion` enum('Activa','Inactiva') NOT NULL,
  `id_detalles_activo` int(11) NOT NULL,
  `id_ti_fk` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id` bigint(20) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id_cargo` int(11) NOT NULL,
  `nombre_cargo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id_cargo`, `nombre_cargo`) VALUES
(1, 'Coordinadora Tecnologia e Informatica'),
(2, 'Auxiliar Tecnologia e Informatica'),
(3, 'Auxiliar SST'),
(4, 'Coordinador SIG'),
(5, 'Auxiliar Administrativo'),
(6, 'Director Administativo'),
(7, 'Directora Operaciones'),
(8, 'Cordinador Operaciones'),
(9, 'Analista Operaciones'),
(10, 'Auxiliar Operaciones'),
(11, 'Mensajero'),
(12, 'Directora Contable'),
(13, 'Auxiliar Contable'),
(14, 'Lider Jurico'),
(15, 'Coordinador Tecnico'),
(16, 'Auxiliar de Gestion Documental'),
(18, 'Auxiliar de Monitoreo'),
(19, 'Gerente'),
(20, 'Supernumeraria'),
(21, 'Practicante SIG'),
(22, 'Jefe de Seguridad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_op`
--

CREATE TABLE `categoria_op` (
  `id_categoriaop` int(11) NOT NULL,
  `nombre_categoriaop` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `categoria_op`
--

INSERT INTO `categoria_op` (`id_categoriaop`, `nombre_categoriaop`) VALUES
(1, 'Duta'),
(2, 'Inspección De Residuos Sin Valor Comercial'),
(3, 'Inspección De Residuos Con Valor Comercial'),
(4, 'Traslados Entre Bodegas'),
(5, 'Salida De Desperdicios Sin Valor Comercial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id` int(11) NOT NULL,
  `clase` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id`, `clase`) VALUES
(1, 'controladores/plantilla.controlador.php'),
(2, 'controladores/usuarios.controlador.php'),
(3, 'controladores/utilerias.controlador.php'),
(4, 'controladores/empresa.controlador.php'),
(5, 'controladores/perfiles.controlador.php'),
(6, 'modelos/usuarios.modelo.php'),
(7, 'modelos/empresa.modelo.php'),
(8, 'modelos/perfiles.modelo.php'),
(9, 'modelos/bitacora.modelo.php'),
(10, 'controladores/clientes.controlador.php'),
(11, 'modelos/clientes.modelo.php'),
(12, 'controladores/inspeccion.controlador.php'),
(13, 'modelos/inspeccion.modelo.php'),
(14, 'controladores/clientes.controlador.php'),
(16, 'controladores/activos.controlador.php'),
(17, 'modelos/activos.modelo.php'),
(18, 'controladores/proveedor.controlador.php'),
(19, 'modelos/proveedor.modelo.php'),
(20, 'controladores/soporte.controlador.php'),
(21, 'modelos/soporte.modelo.php'),
(22, 'modelos/inventario.modelo.php'),
(23, 'controladores/inventario.controlador.php'),
(24, 'modelos/verificacion.modelo.php'),
(25, 'controladores/verificacion.controlador.php'),
(26, 'modelos/sadoc.modelo.php'),
(27, 'controladores/sadoc.controlador.php'),
(28, 'modelos/mantenimiento.modelo.php'),
(29, 'controladores/mantenimiento.controlador.php'),
(38, 'modelos/verificacion.modelo.php'),
(39, 'controladores/verificacion.controlador.php'),
(43, 'modelos/mantenimiento.modelo.php'),
(44, 'controladores/actualizarPw.controlador.php'),
(45, 'modelos/actualizarPw.modelo.php'),
(46, 'modelos/acpm.modelo.php'),
(47, 'modelos/sadoc.modelo.php'),
(48, 'controladores/sadoc.controlador.php'),
(49, 'controladores/actualizarPw.controlador.php'),
(50, 'modelos/actualizarPw.modelo.php'),
(51, 'modelos/tecnica.modelo.php'),
(52, 'controladores/tecnica.controlador.php'),
(53, 'modelos/juridico.modelo.php'),
(54, 'controladores/juridico.controlador.php'),
(55, 'modelos/codificacion.modelo.php'),
(56, 'controladores/codificacion.controlador.php'),
(57, 'modelos/backup.modelo.php'),
(58, 'controladores/backup.controlador.php'),
(59, 'controladores/consumibles.controlador.php'),
(60, 'modelos/consumibles.modelo.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_zfip`
--

CREATE TABLE `clientes_zfip` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(400) DEFAULT NULL,
  `email_cliente` text DEFAULT NULL,
  `telefono_cliente` varchar(15) DEFAULT NULL,
  `direccion_cliente` text DEFAULT NULL,
  `tipo_zf` enum('zfip','clinica') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes_zfip`
--

INSERT INTO `clientes_zfip` (`id_cliente`, `nombre_cliente`, `email_cliente`, `telefono_cliente`, `direccion_cliente`, `tipo_zf`) VALUES
(42024, 'Mariana Montoya', 'mariana@zonafrancadepereira.com', '3017608465', 'Crr 5c', 'clinica'),
(1087561072, 'Melissa Montoya', 'melissa@zonafrancadepereira.com', '3017608465', 'Crr 5c', 'zfip');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_consumibles`
--

CREATE TABLE `compras_consumibles` (
  `id_consumible` int(11) NOT NULL,
  `fecha_compra` date DEFAULT NULL,
  `tipo_consumible` int(11) DEFAULT NULL,
  `cantidad_adquirida` int(20) DEFAULT NULL,
  `precio_unitario` double DEFAULT NULL,
  `total_compra` double DEFAULT NULL,
  `proveedor_consumible` varchar(200) DEFAULT NULL,
  `numero_factura` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `compras_consumibles`
--

INSERT INTO `compras_consumibles` (`id_consumible`, `fecha_compra`, `tipo_consumible`, `cantidad_adquirida`, `precio_unitario`, `total_compra`, `proveedor_consumible`, `numero_factura`) VALUES
(15, '2024-11-21', 2, 2, 2000, 4000, '5', 4),
(16, '2024-11-21', 3, 5, 45000, 225000, '5', 5),
(17, '2024-11-21', 3, 5, 5, 25, '6', 5),
(18, '2024-11-21', 2, 1, 1, 1, '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracioncorreo`
--

CREATE TABLE `configuracioncorreo` (
  `correoSaliente` varchar(75) DEFAULT NULL,
  `host` varchar(30) DEFAULT NULL,
  `SMTPDebug` int(11) DEFAULT NULL,
  `SMTPAuth` tinyint(1) DEFAULT NULL,
  `Puerto` int(11) DEFAULT NULL,
  `clave` varchar(250) DEFAULT NULL,
  `SMTPSeguridad` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `configuracioncorreo`
--

INSERT INTO `configuracioncorreo` (`correoSaliente`, `host`, `SMTPDebug`, `SMTPAuth`, `Puerto`, `clave`, `SMTPSeguridad`) VALUES
('correo@asd.com', 'smtp.gmail.com', 2, 1, 465, 'CEsar1234578@', 'ssl');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consumibles`
--

CREATE TABLE `consumibles` (
  `id_tipo_consumible` int(11) NOT NULL,
  `nombre_consumible` varchar(100) DEFAULT NULL,
  `entrada` int(11) NOT NULL,
  `salida` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `consumibles`
--

INSERT INTO `consumibles` (`id_tipo_consumible`, `nombre_consumible`, `entrada`, `salida`, `cantidad`) VALUES
(2, 'TONNER 78A', 22, 1, 0),
(3, 'TONNER 58A', 10, 5, 0),
(4, 'TINTA NEGRA', 0, 0, 0),
(5, 'TINTA FUCSIA', 0, 0, 0),
(6, 'TINTA AMARILLA', 0, 0, 0),
(7, 'TINTA AZUL', 0, 0, 0),
(8, 'CINTA OP', 0, 0, 0),
(10, 'jp', 0, 0, 0),
(11, '45', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `copias_seguridad`
--

CREATE TABLE `copias_seguridad` (
  `id_backup` int(11) NOT NULL,
  `id_usuario_backup_fk` int(11) DEFAULT NULL,
  `carpeta_backup` varchar(400) DEFAULT NULL,
  `fecha_verificacion` datetime DEFAULT NULL,
  `verificado` enum('Verificado','No verificado') DEFAULT NULL,
  `observaciones_copia` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `copias_seguridad`
--

INSERT INTO `copias_seguridad` (`id_backup`, `id_usuario_backup_fk`, `carpeta_backup`, `fecha_verificacion`, `verificado`, `observaciones_copia`) VALUES
(1, 2, '\\\\192.168.1.50\\j\\BACKUP-MONTOYA', NULL, NULL, NULL),
(2, 2, '\\\\192.168.1.50\\j\\BACKUP-MONTOYA', '2024-11-13 00:00:00', 'Verificado', 'N/A'),
(3, 1, 'gu', NULL, 'No verificado', NULL),
(4, 1, 'gu', '2024-11-13 00:00:00', 'Verificado', 'n/a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_equipos`
--

CREATE TABLE `detalles_equipos` (
  `id_asignacion` int(11) NOT NULL,
  `msd` varchar(50) NOT NULL,
  `antivirus` varchar(50) NOT NULL,
  `visio_pro` varchar(50) NOT NULL,
  `mac_osx` varchar(50) NOT NULL,
  `windows` varchar(50) NOT NULL,
  `autocad` varchar(50) NOT NULL,
  `office` varchar(50) NOT NULL,
  `appolo` varchar(50) NOT NULL,
  `zeus` varchar(50) NOT NULL,
  `otros` text NOT NULL,
  `procesador` varchar(100) NOT NULL,
  `disco_duro` varchar(50) NOT NULL,
  `memoria_ram` varchar(50) NOT NULL,
  `cd_dvd` varchar(300) NOT NULL,
  `tarjeta_video` varchar(300) NOT NULL,
  `tarjeta_red` varchar(300) NOT NULL,
  `tipo_red` enum('Cableada','Wifi') NOT NULL,
  `tiempo_bloqueo` enum('Si','No') NOT NULL,
  `usuario` enum('Si','No') NOT NULL,
  `clave` enum('Si','No') NOT NULL,
  `zfip` enum('Si','No') NOT NULL,
  `privilegios` enum('Estandar','Administrador') NOT NULL,
  `backup` varchar(300) NOT NULL,
  `dia_backup` enum('Lunes','Martes','Miercoles','Jueves','Viernes') NOT NULL,
  `realiza_backup` enum('Si','No') NOT NULL,
  `justificacion_backup` text NOT NULL,
  `id_activo_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_actividad`
--

CREATE TABLE `detalle_actividad` (
  `id_detalle_acpm` int(11) NOT NULL,
  `fecha_evidencia` date NOT NULL DEFAULT current_timestamp(),
  `evidencia` text NOT NULL,
  `recursos` enum('Tecnico','Tecnologico','Humano','Financiero') NOT NULL,
  `id_actividad_fk` int(11) NOT NULL,
  `id_usuario_e_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_codificacion`
--

CREATE TABLE `detalle_codificacion` (
  `id_codificacion` int(11) NOT NULL,
  `codigo_doc_afectado` varchar(200) DEFAULT NULL,
  `nombre_doc_afectado` varchar(200) DEFAULT NULL,
  `afecta` enum('Si','No') DEFAULT NULL,
  `nombre_interna` varchar(100) DEFAULT NULL,
  `correo_interna` varchar(100) DEFAULT NULL,
  `nombre_externa` varchar(100) DEFAULT NULL,
  `correo_externa` varchar(100) DEFAULT NULL,
  `id_codificacion_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_orden`
--

CREATE TABLE `detalle_orden` (
  `id_orden_detalle` int(11) NOT NULL,
  `articulo_compra` text NOT NULL,
  `cantidad_orden` float NOT NULL,
  `valor_neto` float NOT NULL,
  `valor_iva` float NOT NULL,
  `valor_total` float NOT NULL,
  `observaciones_articulo` text NOT NULL,
  `id_orden_compra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pw`
--

CREATE TABLE `detalle_pw` (
  `id_detalle_pw` int(11) NOT NULL,
  `fecha_pw` timestamp NULL DEFAULT current_timestamp(),
  `estado_pw` enum('Proceso','Verificado') DEFAULT NULL,
  `id_usuario_fk` int(11) DEFAULT NULL,
  `id_usuario_ti` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `detalle_pw`
--

INSERT INTO `detalle_pw` (`id_detalle_pw`, `fecha_pw`, `estado_pw`, `id_usuario_fk`, `id_usuario_ti`) VALUES
(1, '2024-09-05 14:11:32', 'Proceso', 1112, NULL),
(2, '2024-09-05 18:52:02', 'Proceso', 1112, NULL),
(3, '2024-09-05 19:02:13', 'Proceso', 1112, NULL),
(4, '2025-01-13 14:34:24', 'Proceso', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_transferencias`
--

CREATE TABLE `historial_transferencias` (
  `id_transferencia` int(11) NOT NULL,
  `id_activo` int(11) NOT NULL,
  `id_usuario_origen` int(11) NOT NULL,
  `id_usuario_destino` int(11) NOT NULL,
  `fecha_transferencia` datetime NOT NULL,
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `historial_transferencias`
--

INSERT INTO `historial_transferencias` (`id_transferencia`, `id_activo`, `id_usuario_origen`, `id_usuario_destino`, `fecha_transferencia`, `observaciones`) VALUES
(29, 182326, 1, 2, '2024-07-11 16:32:20', 'sdas'),
(30, 182327, 1, 2, '2024-07-11 16:32:20', 'sdas'),
(31, 182328, 1, 2, '2024-07-11 16:32:20', 'sdas'),
(32, 182329, 1, 2, '2024-07-11 16:32:20', 'sdas'),
(33, 182330, 1, 2, '2024-07-11 16:32:20', 'sdas'),
(34, 182331, 1, 2, '2024-07-11 16:32:20', 'sdas'),
(35, 182332, 1, 2, '2024-07-11 16:32:20', 'sdas'),
(36, 182333, 1, 2, '2024-07-11 16:32:20', 'sdas'),
(37, 182334, 1, 2, '2024-07-11 16:32:20', 'sdas'),
(38, 182335, 1, 2, '2024-07-11 16:32:20', 'sdas'),
(39, 182336, 1, 2, '2024-07-11 16:32:20', 'sdas'),
(40, 182326, 2, 1, '2024-07-11 16:47:19', ''),
(41, 182327, 2, 1, '2024-07-11 16:47:19', ''),
(42, 182328, 2, 1, '2024-07-11 16:47:19', ''),
(43, 182329, 2, 1, '2024-07-11 16:47:19', ''),
(44, 182330, 2, 1, '2024-07-11 16:47:19', ''),
(45, 182331, 2, 1, '2024-07-11 16:47:19', ''),
(46, 182332, 2, 1, '2024-07-11 16:47:19', ''),
(47, 182333, 2, 1, '2024-07-11 16:47:19', ''),
(48, 182334, 2, 1, '2024-07-11 16:47:19', ''),
(49, 182335, 2, 1, '2024-07-11 16:47:19', ''),
(50, 182336, 2, 1, '2024-07-11 16:47:19', ''),
(51, 182326, 1, 2, '2024-07-12 17:40:37', 'NUEVO CARGO'),
(52, 182327, 1, 2, '2024-07-12 17:40:38', 'NUEVO CARGO'),
(53, 182328, 1, 2, '2024-07-12 17:40:39', 'NUEVO CARGO'),
(54, 182329, 1, 2, '2024-07-12 17:40:40', 'NUEVO CARGO'),
(55, 182330, 1, 2, '2024-07-12 17:40:41', 'NUEVO CARGO'),
(56, 182331, 1, 2, '2024-07-12 17:40:42', 'NUEVO CARGO'),
(57, 182332, 1, 2, '2024-07-12 17:40:43', 'NUEVO CARGO'),
(58, 182333, 1, 2, '2024-07-12 17:40:43', 'NUEVO CARGO'),
(59, 182334, 1, 2, '2024-07-12 17:40:44', 'NUEVO CARGO'),
(60, 182335, 1, 2, '2024-07-12 17:40:45', 'NUEVO CARGO'),
(61, 182336, 1, 2, '2024-07-12 17:40:46', 'NUEVO CARGO'),
(62, 182337, 1, 2, '2024-07-12 17:40:47', 'NUEVO CARGO'),
(63, 182326, 2, 1, '2024-07-12 17:41:41', 'NUEVO TRASLADO'),
(64, 182327, 2, 1, '2024-07-12 17:41:42', 'NUEVO TRASLADO'),
(65, 182328, 2, 1, '2024-07-12 17:41:43', 'NUEVO TRASLADO'),
(66, 182329, 2, 1, '2024-07-12 17:41:44', 'NUEVO TRASLADO'),
(67, 182330, 2, 1, '2024-07-12 17:41:45', 'NUEVO TRASLADO'),
(68, 182331, 2, 1, '2024-07-12 17:41:45', 'NUEVO TRASLADO'),
(69, 182332, 2, 1, '2024-07-12 17:41:46', 'NUEVO TRASLADO'),
(70, 182333, 2, 1, '2024-07-12 17:41:47', 'NUEVO TRASLADO'),
(71, 182334, 2, 1, '2024-07-12 17:41:48', 'NUEVO TRASLADO'),
(72, 182335, 2, 1, '2024-07-12 17:41:49', 'NUEVO TRASLADO'),
(73, 182336, 2, 1, '2024-07-12 17:41:50', 'NUEVO TRASLADO'),
(74, 182337, 2, 1, '2024-07-12 17:41:51', 'NUEVO TRASLADO'),
(75, 182326, 1, 2, '2024-07-12 19:19:09', ''),
(76, 182327, 1, 2, '2024-07-12 19:19:10', ''),
(77, 182328, 1, 2, '2024-07-12 19:19:11', ''),
(78, 182329, 1, 2, '2024-07-12 19:19:12', ''),
(79, 182330, 1, 2, '2024-07-12 19:19:13', ''),
(80, 182331, 1, 2, '2024-07-12 19:19:14', ''),
(81, 182332, 1, 2, '2024-07-12 19:19:14', ''),
(82, 182333, 1, 2, '2024-07-12 19:19:15', ''),
(83, 182334, 1, 2, '2024-07-12 19:19:16', ''),
(84, 182335, 1, 2, '2024-07-12 19:19:17', ''),
(85, 182336, 1, 2, '2024-07-12 19:19:18', ''),
(86, 182337, 1, 2, '2024-07-12 19:19:18', ''),
(87, 182340, 1, 1, '2024-08-23 15:18:52', 'fdf'),
(88, 182328, 2, 10, '2025-01-16 07:53:26', 'Ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impresoras`
--

CREATE TABLE `impresoras` (
  `id_impresora` int(11) NOT NULL,
  `nombre_impresora` varchar(300) DEFAULT NULL,
  `modelo_impresora` varchar(200) DEFAULT NULL,
  `serial_impresora` varchar(200) DEFAULT NULL,
  `ubicacion_impresora` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `impresoras`
--

INSERT INTO `impresoras` (`id_impresora`, `nombre_impresora`, `modelo_impresora`, `serial_impresora`, `ubicacion_impresora`) VALUES
(1, 'HP Smart Tank 710-720 series UO', NULL, 'CN31G5742B', 'Usuario Operador'),
(2, 'HP LaserJet Professional P1606dn UO', 'BOISB-0902-00', 'VNB3G04919', 'Usuario Operador'),
(3, 'HP68A8A9 (HP LaserJet Pro M428f-M429f-UO)', 'VCVRA-1712', 'MXBPMCBOLH', 'Usuario Operador'),
(4, 'HP LaserJet Pro MFP M428fdw', 'VCVRA-1712', 'MXBPMCC 17T', 'Operaciones'),
(5, 'HP Laserjet P1606dn', 'BOISB-0902-00', 'VND3G35495', 'Operaciones'),
(6, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inspeccion_op`
--

CREATE TABLE `inspeccion_op` (
  `id_inspeccion` int(11) NOT NULL,
  `id_cliente_fk` int(11) NOT NULL,
  `ingreso_salida` enum('ingreso','salida') NOT NULL,
  `id_categoriaop_fk` int(11) NOT NULL,
  `otro_operacion` text DEFAULT NULL,
  `transito` varchar(11) NOT NULL,
  `fmm` varchar(11) NOT NULL,
  `arin` varchar(11) NOT NULL,
  `documento` varchar(11) DEFAULT NULL,
  `fisico` varchar(11) DEFAULT NULL,
  `estado` enum('bueno','regular','malo') NOT NULL,
  `descripcion_observaciones` text DEFAULT NULL,
  `nombre_firma` varchar(255) DEFAULT NULL,
  `cc_firma` varchar(255) DEFAULT NULL,
  `firma_recibido` text NOT NULL,
  `fecha_inspeccion` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_usuario_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `inspeccion_op`
--

INSERT INTO `inspeccion_op` (`id_inspeccion`, `id_cliente_fk`, `ingreso_salida`, `id_categoriaop_fk`, `otro_operacion`, `transito`, `fmm`, `arin`, `documento`, `fisico`, `estado`, `descripcion_observaciones`, `nombre_firma`, `cc_firma`, `firma_recibido`, `fecha_inspeccion`, `id_usuario_fk`) VALUES
(1, 1087561072, 'ingreso', 4, '', '45', '45', '45', '45', '45', 'bueno', '45', '45', '45', 'vistas/img/usuarios/firmas_inspeccion/6785253f345fe.png', '2025-01-13 14:37:51', 1087561072),
(2, 1087561072, 'ingreso', 5, '', '23', '34', '34', '1087', '13', 'bueno', 'Ninguno', 'Melissa', '42024431', 'vistas/img/usuarios/firmas_inspeccion/678527c3ec930.png', '2025-01-22 14:48:35', 1087561072),
(3, 42024, 'ingreso', 2, 'REVISION', '8541', '8245', '852', '20', '20', 'regular', '11223', 'YULIANA ANDREA LOPEZ', '10254896225', 'vistas/img/usuarios/firmas_inspeccion/6787f8035514e.png', '2025-02-20 18:01:39', 1087561072);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL,
  `fecha_apertura` date NOT NULL,
  `estado_inventario` enum('Abierto','Cerrado') NOT NULL,
  `id_usuario_apertura` int(11) NOT NULL,
  `fecha_cierre` date DEFAULT NULL,
  `id_usuario_cierre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_inventario`, `fecha_apertura`, `estado_inventario`, `id_usuario_apertura`, `fecha_cierre`, `id_usuario_cierre`) VALUES
(16, '2025-01-16', 'Abierto', 1087561072, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimientos`
--

CREATE TABLE `mantenimientos` (
  `id_mantenimiento` int(11) NOT NULL,
  `fecha_mantenimiento` date DEFAULT NULL,
  `id_usuario_fk` int(11) DEFAULT NULL,
  `marca` varchar(200) DEFAULT NULL,
  `modelo` varchar(200) DEFAULT NULL,
  `serie` varchar(100) DEFAULT NULL,
  `usuario_equipo` varchar(100) DEFAULT NULL,
  `soplar_partes_externas` enum('SI','NO') DEFAULT NULL,
  `lubricar_puertos` enum('SI','NO') DEFAULT NULL,
  `limpieza_equipo` enum('SI','NO') DEFAULT NULL,
  `limpiar_partes_interna` enum('SI','NO') DEFAULT NULL,
  `verificar_usuario` enum('SI','NO') DEFAULT NULL,
  `contra` enum('SI','NO') DEFAULT NULL,
  `formato_asignacion_equipo` enum('SI','NO') DEFAULT NULL,
  `depurar_temporales` enum('SI','NO') DEFAULT NULL,
  `liberar_espacio` enum('SI','NO') DEFAULT NULL,
  `desinstalar_programas` enum('SI','NO') DEFAULT NULL,
  `actualizar_logos` enum('SI','NO') DEFAULT NULL,
  `verificar_actualizaciones` enum('SI','NO') DEFAULT NULL,
  `desfragmentar` enum('SI','NO') DEFAULT NULL,
  `usuario` enum('SI','NO') DEFAULT NULL,
  `clave` enum('SI','NO') DEFAULT NULL,
  `estandar` enum('SI','NO') DEFAULT NULL,
  `administrador` enum('SI','NO') DEFAULT NULL,
  `analisis_completo` enum('SI','NO') DEFAULT NULL,
  `bloqueo_usb` enum('SI','NO') DEFAULT NULL,
  `dominio_zfip` enum('SI','NO') DEFAULT NULL,
  `apagar_pantalla` enum('SI','NO') DEFAULT NULL,
  `estado_suspension` enum('SI','NO') DEFAULT NULL,
  `firma` text DEFAULT NULL,
  `estado_mantenimiento_equipo` enum('Sin Firmar','Firmado') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mantenimientos`
--

INSERT INTO `mantenimientos` (`id_mantenimiento`, `fecha_mantenimiento`, `id_usuario_fk`, `marca`, `modelo`, `serie`, `usuario_equipo`, `soplar_partes_externas`, `lubricar_puertos`, `limpieza_equipo`, `limpiar_partes_interna`, `verificar_usuario`, `contra`, `formato_asignacion_equipo`, `depurar_temporales`, `liberar_espacio`, `desinstalar_programas`, `actualizar_logos`, `verificar_actualizaciones`, `desfragmentar`, `usuario`, `clave`, `estandar`, `administrador`, `analisis_completo`, `bloqueo_usb`, `dominio_zfip`, `apagar_pantalla`, `estado_suspension`, `firma`, `estado_mantenimiento_equipo`) VALUES
(20, '2024-11-21', 1, 'NOC', '159', '1', 'ñ', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'NO', 'SI', 'SI', 'SI', 'SI', 'SI', 'vistas/img/usuarios/firmas/firma_yaque.png', 'Firmado'),
(21, '2024-11-26', 1087561072, 'NOC', '1', '1', '1', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'vistas/img/usuarios/firmas/firma_yaque.png', 'Firmado'),
(22, '2024-11-27', 1087561072, '4', '4', '4', '4', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'vistas/img/usuarios/firmas/firma_yaque.png', 'Firmado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_general`
--

CREATE TABLE `mantenimiento_general` (
  `id_general` int(100) NOT NULL,
  `fecha_mantenimiento3` date NOT NULL,
  `id_usuario_fk3` int(11) NOT NULL,
  `articulo` varchar(100) NOT NULL,
  `marca_general` varchar(100) NOT NULL,
  `modelo_general` varchar(100) NOT NULL,
  `serial_general` varchar(100) NOT NULL,
  `partes_externas` enum('SI','NO') NOT NULL,
  `condiciones_fisicas` enum('SI','NO') NOT NULL,
  `cableado_verificar` enum('SI','NO') NOT NULL,
  `dispositivo` enum('SI','NO') NOT NULL,
  `estado_general` enum('Sin Firmar','Firmado') NOT NULL,
  `firma_general` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mantenimiento_general`
--

INSERT INTO `mantenimiento_general` (`id_general`, `fecha_mantenimiento3`, `id_usuario_fk3`, `articulo`, `marca_general`, `modelo_general`, `serial_general`, `partes_externas`, `condiciones_fisicas`, `cableado_verificar`, `dispositivo`, `estado_general`, `firma_general`) VALUES
(4, '2024-09-04', 1, '1', '1', '1', '1', 'SI', 'SI', 'SI', 'SI', 'Sin Firmar', 'vistas/img/usuarios/firmas/firma_yaque.png'),
(5, '2024-11-27', 1087561072, '4', '4', '4', '4', 'SI', 'SI', 'SI', 'SI', 'Firmado', 'vistas/img/usuarios/firmas/firma_yaque.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_impresora`
--

CREATE TABLE `mantenimiento_impresora` (
  `id_impresora` int(200) NOT NULL,
  `fecha_mantenimiento_impresora` date NOT NULL,
  `id_usuario_fk2` int(11) NOT NULL,
  `nombre_impresora` varchar(200) NOT NULL,
  `marca_impresora` varchar(200) NOT NULL,
  `modelo_impresora` varchar(200) NOT NULL,
  `serial_impresora` varchar(200) NOT NULL,
  `soplar_exterior` enum('Si','No') NOT NULL,
  `isopropilico` enum('Si','No') NOT NULL,
  `toner` enum('Si','No') NOT NULL,
  `alinear` enum('Si','No') NOT NULL,
  `verificar_cableado` enum('Si','No') NOT NULL,
  `rodillos` enum('Si','No') NOT NULL,
  `reemplazar` enum('Si','No') NOT NULL,
  `limpiar` enum('Si','No') NOT NULL,
  `imprimir` enum('Si','No') NOT NULL,
  `verificar` enum('SI','NO') NOT NULL,
  `estado_mantenimiento_impresora` enum('Sin Firmar','Firmado') NOT NULL,
  `firma_impresora` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mantenimiento_impresora`
--

INSERT INTO `mantenimiento_impresora` (`id_impresora`, `fecha_mantenimiento_impresora`, `id_usuario_fk2`, `nombre_impresora`, `marca_impresora`, `modelo_impresora`, `serial_impresora`, `soplar_exterior`, `isopropilico`, `toner`, `alinear`, `verificar_cableado`, `rodillos`, `reemplazar`, `limpiar`, `imprimir`, `verificar`, `estado_mantenimiento_impresora`, `firma_impresora`) VALUES
(6, '2024-09-05', 1, '1', '11', '1', '1', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'SI', 'Sin Firmar', NULL),
(7, '2024-11-27', 1087561072, '4', '4', '4', '4', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'SI', 'Firmado', 'vistas/img/usuarios/firmas/firma_yaque.png'),
(8, '2024-11-27', 1087561072, '4', '4', '4', '4', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'SI', 'Sin Firmar', NULL),
(9, '2024-11-20', 1087561072, '5', '5', '5', '5', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'SI', 'Sin Firmar', NULL),
(10, '2025-01-15', 2, 'HP COLOR', 'HP', 'GFGF', 'GFGRF', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'SI', 'Firmado', 'vistas/img/usuarios/firmas/firma_yaque.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

CREATE TABLE `orden_compra` (
  `id_orden` int(11) NOT NULL,
  `fecha_orden` date DEFAULT NULL,
  `proveedor_recurrente` enum('Si','No') NOT NULL,
  `forma_pago` enum('Contado','Credito','Anticipo','Otros') DEFAULT NULL,
  `tiempo_pago` varchar(50) DEFAULT NULL,
  `porcentaje_anticipo` float DEFAULT NULL,
  `condiciones_negociacion` text DEFAULT NULL,
  `comentario_orden` text DEFAULT NULL,
  `tiempo_entrega` varchar(300) DEFAULT NULL,
  `total_orden` float DEFAULT NULL,
  `analisis_cotizacion` enum('Si','No') DEFAULT NULL,
  `estado_orden` enum('Proceso','Aprobada','Denegada','Analisis de Cotizacion','Ejecutada') DEFAULT NULL,
  `descripcion_declinado` text DEFAULT NULL,
  `fecha_aprobacion` datetime DEFAULT NULL,
  `id_cotizante` int(11) DEFAULT NULL,
  `id_proveedor_fk` int(11) DEFAULT NULL,
  `id_gerente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `perfil` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `ModuloTI` enum('off','on') DEFAULT NULL,
  `AdminUsuarios` enum('off','on') DEFAULT NULL,
  `VerUsuarios` enum('off','on') DEFAULT NULL,
  `EstadoUsuarios` enum('off','on') DEFAULT NULL,
  `AdminPerfiles` enum('off','on') DEFAULT NULL,
  `AdminMantenimientos` enum('off','on') DEFAULT NULL,
  `InventarioEquipos` enum('off','on') DEFAULT NULL,
  `AdminSoporte` enum('off','on') DEFAULT NULL,
  `SolicitudSoporte` enum('off','on') DEFAULT NULL,
  `ConsultarSoporte` enum('off','on') DEFAULT NULL,
  `AdminAcpm` enum('off','on') DEFAULT NULL,
  `CrearAcpm` enum('on','off') DEFAULT NULL,
  `ConsultarAcpm` enum('off','on') DEFAULT NULL,
  `EditarAcpm` enum('off','on') DEFAULT NULL,
  `EliminarAcpm` enum('off','on') DEFAULT NULL,
  `AsignarActividades` enum('off','on') DEFAULT NULL,
  `ResponderActividades` enum('off','on') DEFAULT NULL,
  `VerActividades` enum('on','off') DEFAULT NULL,
  `EditarActividades` enum('off','on') DEFAULT NULL,
  `EliminarActividades` enum('off','on') DEFAULT NULL,
  `ArchivosSadoc` enum('off','on') DEFAULT NULL,
  `CarpetasSadoc` enum('off','on') DEFAULT NULL,
  `EliminarSadoc` enum('off','on') DEFAULT NULL,
  `SolicitudCodificacion` enum('off','on') DEFAULT NULL,
  `ResponderCodificacion` enum('off','on') DEFAULT NULL,
  `ConsultarCodificacion` enum('off','on') DEFAULT NULL,
  `EditarCodificacion` enum('off','on') DEFAULT NULL,
  `EliminarCodificacion` enum('off','on') DEFAULT NULL,
  `CrearOrden` enum('off','on') DEFAULT NULL,
  `EditarOrden` enum('off','on') DEFAULT NULL,
  `EliminarOrden` enum('off','on') DEFAULT NULL,
  `ConsultarOrden` enum('off','on') DEFAULT NULL,
  `AdminProveedorLider` enum('off','on') DEFAULT NULL,
  `AdminProveedorCT` enum('off','on') DEFAULT NULL,
  `AprobacionGH` enum('off','on') DEFAULT NULL,
  `AprobacionGR` enum('off','on') DEFAULT NULL,
  `AprobacionCT` enum('off','on') DEFAULT NULL,
  `CrearBascula` enum('off','on') DEFAULT NULL,
  `ConsultarBascula` enum('off','on') DEFAULT NULL,
  `EditarBascula` enum('off','on') DEFAULT NULL,
  `BasculaProceso` enum('off','on') DEFAULT NULL,
  `BasculaFact` enum('off','on') DEFAULT NULL,
  `ValorPesaje` enum('off','on') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`perfil`, `descripcion`, `ModuloTI`, `AdminUsuarios`, `VerUsuarios`, `EstadoUsuarios`, `AdminPerfiles`, `AdminMantenimientos`, `InventarioEquipos`, `AdminSoporte`, `SolicitudSoporte`, `ConsultarSoporte`, `AdminAcpm`, `CrearAcpm`, `ConsultarAcpm`, `EditarAcpm`, `EliminarAcpm`, `AsignarActividades`, `ResponderActividades`, `VerActividades`, `EditarActividades`, `EliminarActividades`, `ArchivosSadoc`, `CarpetasSadoc`, `EliminarSadoc`, `SolicitudCodificacion`, `ResponderCodificacion`, `ConsultarCodificacion`, `EditarCodificacion`, `EliminarCodificacion`, `CrearOrden`, `EditarOrden`, `EliminarOrden`, `ConsultarOrden`, `AdminProveedorLider`, `AdminProveedorCT`, `AprobacionGH`, `AprobacionGR`, `AprobacionCT`, `CrearBascula`, `ConsultarBascula`, `EditarBascula`, `BasculaProceso`, `BasculaFact`, `ValorPesaje`) VALUES
(56, 'MELISSA', 'off', 'on', 'on', 'on', 'on', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso`
--

CREATE TABLE `proceso` (
  `id_proceso` int(11) NOT NULL,
  `siglas_proceso` varchar(20) NOT NULL,
  `nombre_proceso` varchar(30) NOT NULL,
  `estado_proceso` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `proceso`
--

INSERT INTO `proceso` (`id_proceso`, `siglas_proceso`, `nombre_proceso`, `estado_proceso`) VALUES
(1, 'SIG', 'Sistema Integrado de Gestion', 'Activo'),
(2, 'TI', 'Tecnologi­a e Informatica', 'Activo'),
(3, 'CT', 'Contabilidad', 'Activo'),
(4, 'TEC', 'Tecnico', 'Activo'),
(5, 'GH', 'Gestion Humana', 'Activo'),
(6, 'GD', 'Gestion Documental', 'Activo'),
(7, 'OP', 'Operaciones', 'Activo'),
(8, 'PH', 'Propiedad Horizontal', 'Activo'),
(9, 'SST', 'Seguridad Salud en el Trabajo', 'Activo'),
(10, 'GR', 'Gerencia', 'Activo'),
(11, 'JR', 'Gestion Juridica', 'Activo'),
(12, 'PLE', 'Planeacion Estrategia', 'Activo'),
(13, 'SG', 'SEGURIDAD', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_compras`
--

CREATE TABLE `proveedor_compras` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(200) NOT NULL,
  `contacto_proveedor` varchar(100) NOT NULL,
  `telefono_proveedor` varchar(15) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `proveedor_compras`
--

INSERT INTO `proveedor_compras` (`id_proveedor`, `nombre_proveedor`, `contacto_proveedor`, `telefono_proveedor`, `id_usuario_fk`) VALUES
(1087561072, 'Melissa Montoya', 'ymontoyag@zonafrancadepereira.com', '324541530', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_consumible`
--

CREATE TABLE `registro_consumible` (
  `id_registro` int(11) NOT NULL,
  `id_impresora_fk` int(11) NOT NULL,
  `id_tipo_consumible_fk` int(11) NOT NULL,
  `fecha_instalacion` date DEFAULT NULL,
  `cantidad_utilizada` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `registro_consumible`
--

INSERT INTO `registro_consumible` (`id_registro`, `id_impresora_fk`, `id_tipo_consumible_fk`, `fecha_instalacion`, `cantidad_utilizada`) VALUES
(1, 1, 0, '2024-11-21', NULL),
(2, 2, 0, '2024-11-27', 1),
(3, 4, 4, '2024-11-04', 4),
(4, 1, 3, '2024-11-21', 5),
(5, 1, 2, '2024-11-21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sadoc`
--

CREATE TABLE `sadoc` (
  `id` int(11) NOT NULL,
  `codigo` varchar(200) NOT NULL,
  `ruta` varchar(500) NOT NULL,
  `ruta_principal` varchar(500) NOT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('activo','inactivo') NOT NULL,
  `sub_carpeta` enum('Si','No') NOT NULL,
  `id_proceso_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `sadoc`
--

INSERT INTO `sadoc` (`id`, `codigo`, `ruta`, `ruta_principal`, `fecha_subida`, `estado`, `sub_carpeta`, `id_proceso_fk`) VALUES
(1, '22', 'vistas/modulos/files/TI/Guía de Actividades y Rubrica de Evaluación - Unidad 1 - Tarea 1 - Presaberes.pdf', 'vistas/modulos/files/TI/', '2024-08-27 21:24:09', 'activo', 'No', 2),
(2, 'fff', 'vistas/modulos/files/TI/Anexo 1 - Insumos – Tarea 1.xlsx', 'vistas/modulos/files/TI/', '2024-08-27 21:25:55', 'activo', 'No', 2),
(3, '22', 'vistas/modulos/files/TI/Guía de Actividades y Rubrica de Evaluación - Unidad 1 - Tarea 1 - Presaberes.pdf', 'vistas/modulos/files/TI/', '2024-08-27 21:26:22', 'activo', 'No', 2),
(4, 'tgt', 'vistas/modulos/files/TI/FO-JU-01 solicitud Legal V5.xlsx', 'vistas/modulos/files/TI/', '2024-08-27 21:26:45', 'activo', 'No', 2),
(5, 'yuty6', 'vistas/modulos/files/TI/CONTRATO FIRMADO (2).pdf', 'vistas/modulos/files/TI/', '2024-08-27 21:39:32', 'activo', 'No', 2),
(6, 'huyh', 'vistas/modulos/files/TI/diploma-seguridad-empresas.pdf', 'vistas/modulos/files/TI/', '2024-08-27 21:39:51', 'activo', 'No', 2),
(7, 'ghh', 'vistas/modulos/files/TI/Infografía.pdf', 'vistas/modulos/files/TI/', '2024-08-27 21:40:19', 'activo', 'No', 2),
(8, 'fsdf', 'vistas/modulos/files/TI/Cta de Cobro Melissa Montoya.pdf', 'vistas/modulos/files/TI/', '2024-08-27 21:55:35', 'activo', 'No', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_codificacion`
--

CREATE TABLE `solicitud_codificacion` (
  `id_codificacion` int(11) NOT NULL,
  `vigencia` enum('Nuevo','Antiguo') DEFAULT NULL,
  `fecha_solicitud_cod` date DEFAULT NULL,
  `usuario_solicitud_cod` varchar(200) DEFAULT NULL,
  `cargo_solicitud_cod` varchar(200) DEFAULT NULL,
  `nombre_documento` varchar(100) DEFAULT NULL,
  `codigo` varchar(100) DEFAULT NULL,
  `descripcion_cambio` varchar(200) DEFAULT NULL,
  `link_formato_codificacion` varchar(500) DEFAULT NULL,
  `elabora_nombre` varchar(100) DEFAULT NULL,
  `elabora_correo` varchar(100) DEFAULT NULL,
  `revisa_nombre` varchar(100) DEFAULT NULL,
  `revisa_correo` varchar(100) DEFAULT NULL,
  `aprueba_nombre` varchar(100) DEFAULT NULL,
  `aprueba_correo` varchar(100) DEFAULT NULL,
  `codigo_doc_afectado` varchar(100) DEFAULT NULL,
  `nombre_doc_afectado` varchar(100) DEFAULT NULL,
  `afecta` enum('Si','No') DEFAULT NULL,
  `todos_colaboradores` enum('Si','No') DEFAULT NULL,
  `solo_lider` enum('Si','No') DEFAULT NULL,
  `miembros_proceso` enum('Si','No') DEFAULT NULL,
  `nombre_proceso_cod` varchar(100) DEFAULT NULL,
  `colaborador_expecifico` enum('Si','No') DEFAULT NULL,
  `nombre_interna` varchar(100) DEFAULT NULL,
  `correo_interna` varchar(100) DEFAULT NULL,
  `nombre_externa` varchar(100) DEFAULT NULL,
  `correo_externa` varchar(100) DEFAULT NULL,
  `enviar_copia` enum('Si','No') DEFAULT NULL,
  `estado_sig_codificacion` enum('Aprobado','Rechazado') DEFAULT NULL,
  `fecha_sig_codificacion` date DEFAULT NULL,
  `responsable_sig_codificacion` varchar(100) DEFAULT NULL,
  `causa_rechazo_codificacion` varchar(500) DEFAULT NULL,
  `evidencia_difucion` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soporte`
--

CREATE TABLE `soporte` (
  `id_soporte` int(11) NOT NULL,
  `fecha_soporte` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_usuario_fk` int(11) NOT NULL,
  `descripcion_soporte` text NOT NULL,
  `urgencia` enum('Urgente','Urgencia media','Prioridad baja') DEFAULT NULL,
  `solucion_soporte` varchar(200) DEFAULT NULL,
  `fecha_solucion` date DEFAULT NULL,
  `usuario_respuesta` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `soporte`
--

INSERT INTO `soporte` (`id_soporte`, `fecha_soporte`, `id_usuario_fk`, `descripcion_soporte`, `urgencia`, `solucion_soporte`, `fecha_solucion`, `usuario_respuesta`) VALUES
(110, '2024-07-12 19:16:50', 1, '<p>156<img src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQMAAADCCAMAAAB6zFdcAAAAA1BMVEUAmXUnlok6AAAASElEQVR4nO3BMQEAAADCoPVPbQwfoAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAIC3AcUIAAFkqh/QAAAAAElFTkSuQmCC\" data-filename=\"images.png\" style=\"width: 259px;\"></p>', 'Urgencia media', '123', '2024-07-12', 'Yaqueline Garcia Zapata'),
(111, '2024-07-25 13:37:47', 1, '<p>123</p>', 'Urgencia media', '123', '2024-07-25', 'Yaqueline Garcia Zapata'),
(112, '2024-08-08 20:03:40', 1, '<p>123</p>', NULL, NULL, NULL, NULL),
(113, '2024-08-09 14:39:04', 1, '<p>123</p>', NULL, NULL, NULL, NULL),
(114, '2024-08-09 14:50:48', 1, '<p>1</p>', NULL, NULL, NULL, NULL),
(115, '2024-08-09 14:53:45', 1, '<p>1</p>', NULL, NULL, NULL, NULL),
(116, '2024-08-09 15:06:39', 1, '<p>25</p>', NULL, NULL, NULL, NULL),
(117, '2024-09-19 15:47:25', 1087561072, '<p>56</p>', NULL, NULL, NULL, NULL),
(118, '2024-09-19 16:52:33', 1087561072, '<p>89</p>', NULL, NULL, NULL, NULL),
(119, '2024-09-19 16:57:18', 1087561072, '<p>89</p>', NULL, NULL, NULL, NULL),
(120, '2024-09-19 16:58:52', 1087561072, '<p>89</p>', NULL, NULL, NULL, NULL),
(121, '2024-09-19 16:59:55', 1087561072, '<p>as</p>', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soporte_juridico`
--

CREATE TABLE `soporte_juridico` (
  `id_soporte_juridico` int(11) NOT NULL,
  `nombre_solicitante` int(11) DEFAULT NULL,
  `correo_solicitante` varchar(100) DEFAULT NULL,
  `id_cargo_fk1` int(11) DEFAULT NULL,
  `fecha_solicitud` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_proceso_fk1` int(11) DEFAULT NULL,
  `tipo_solicitud` varchar(200) DEFAULT NULL,
  `descripcion_solicitud_juridico` varchar(400) DEFAULT NULL,
  `estado_legal` enum('Abierto','Cerrado','Rechazado','Proceso') DEFAULT NULL,
  `fecha_solucion_juridico` date DEFAULT NULL,
  `nombre_solucion` varchar(100) DEFAULT NULL,
  `solucion_juridico` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `soporte_juridico`
--

INSERT INTO `soporte_juridico` (`id_soporte_juridico`, `nombre_solicitante`, `correo_solicitante`, `id_cargo_fk1`, `fecha_solicitud`, `id_proceso_fk1`, `tipo_solicitud`, `descripcion_solicitud_juridico`, `estado_legal`, `fecha_solucion_juridico`, `nombre_solucion`, `solucion_juridico`) VALUES
(45, 10, 'ygarciaz@zonafrancadepereira.com', 2, '2024-10-29 15:53:52', 2, 'PRUEBA', '<p>PRUEBA</p>', 'Abierto', '2024-10-29', 'Maria Valentina', 'PRUEBA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soporte_tecnico`
--

CREATE TABLE `soporte_tecnico` (
  `id_soporte_tecnico` int(11) NOT NULL,
  `fecha_soporte_tecnico` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_usuario_fk1` int(11) NOT NULL,
  `correo_soporte` varchar(100) NOT NULL,
  `proceso_fk1` int(11) NOT NULL,
  `descripcion_soporte_tecnico` varchar(500) NOT NULL,
  `solucion_soporte_tecnico` varchar(300) DEFAULT NULL,
  `fecha_solucion_soporte` date DEFAULT NULL,
  `usuario_respuesta` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `soporte_tecnico`
--

INSERT INTO `soporte_tecnico` (`id_soporte_tecnico`, `fecha_soporte_tecnico`, `id_usuario_fk1`, `correo_soporte`, `proceso_fk1`, `descripcion_soporte_tecnico`, `solucion_soporte_tecnico`, `fecha_solucion_soporte`, `usuario_respuesta`) VALUES
(1, '2024-10-18 17:20:47', 1087561072, 'admin123', 2, '<p>2</p>', '1', '2024-10-18', '0'),
(2, '2024-10-18 17:21:36', 1087561072, 'admin123', 2, '<p>123</p>', '2', '2024-10-18', 'Administrador'),
(3, '2024-10-18 18:36:46', 1087561072, 'admin', 2, '<p><img src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAFD4AAAu1CAYAAAAbnq/sAAAACXBIWXMAAC4jAAAuIwF4pT92AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAG3ShJREFUeNrs3EEBACAAhDC1f+czBb8tAgG42w4AAAAAAAAAAAAAAAAAAAAAAAAAQOFJAAAAAAAAAAAAAAAAAAAAAAAAAABUjA8BAAAAAAAAAAAAAAAAAAAAAAAAgIzxIQAAAAAAAAAAAAAAAAAAAAAAAACQMT4EAAAAAAAAAAAAAAAAAAAAAAAAADLGhwAAAAAAAAAAAAAAAAAAAAAAAABAxvgQAAAAAAAAAAAAAAAAAAAAAAAAAMgYHwIAAAAAAAAAAAAAAAAAAAAAAAAAGeNDAAAAAAAAAAAAAAAAAAAAAAAAACBjfAgAAAAAAAAAAAAAAAAAAAAAAAAAZIwPA', NULL, NULL, NULL),
(4, '2024-10-18 19:00:38', 1087561072, 'admin', 2, '<p>1</p>', NULL, NULL, NULL),
(5, '2024-10-18 19:07:56', 1087561072, 'admin', 2, '<p>578</p>', NULL, NULL, NULL),
(6, '2024-10-18 19:39:14', 1087561072, 'admin', 2, '<p>HOLA INGE ESTA ES SU NUEVA PLATAFORMA SERA MONTADA EN DICIEMBRE</p>', NULL, NULL, NULL),
(7, '2024-10-18 19:46:04', 1087561072, 'admin', 2, '<p>HOLA INGE ESTA ES SU NUEVA PLATAFORMA SERA MONTADA EN DICIEMBRE</p>', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `rol_usuario` varchar(100) NOT NULL,
  `admin_acpm` enum('Si','No') NOT NULL,
  `radicar_acpm` enum('Si','No') NOT NULL,
  `admin_sadoc` enum('Si','No') NOT NULL,
  `consultar_sadoc` enum('Si','No') NOT NULL,
  `ordenes` enum('Si','No') NOT NULL,
  `admin_compras` enum('Si','No') NOT NULL,
  `pagar_ordenes` enum('Si','No') NOT NULL,
  `analisis_cotizacion` enum('Si','No') NOT NULL,
  `radicar_orden` enum('Si','No') NOT NULL,
  `firmar_orden` enum('Si','No') NOT NULL,
  `evaluar_proveedor` enum('Si','No') NOT NULL,
  `admin_activos` enum('Si','No','','') NOT NULL,
  `consultar_activos` enum('Si','No','','') NOT NULL,
  `ingresar_activos` enum('Si','No') NOT NULL,
  `editar_activos` enum('Si','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `rol_usuario`, `admin_acpm`, `radicar_acpm`, `admin_sadoc`, `consultar_sadoc`, `ordenes`, `admin_compras`, `pagar_ordenes`, `analisis_cotizacion`, `radicar_orden`, `firmar_orden`, `evaluar_proveedor`, `admin_activos`, `consultar_activos`, `ingresar_activos`, `editar_activos`) VALUES
(1, 'superadmin', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si'),
(2, 'admin_sig', 'Si', 'Si', 'Si', 'Si', 'Si', 'No', 'No', 'No', 'Si', 'No', 'Si', 'Si', 'Si', 'Si', 'Si'),
(3, 'usuario_aux', 'No', 'No', 'No', 'Si', 'Si', 'No', 'No', 'No', 'No', 'No', 'No', 'Si', 'Si', 'Si', 'Si'),
(4, 'gerencia', 'No', 'Si', 'No', 'Si', 'Si', 'No', 'No', 'No', 'No', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si'),
(5, 'directivo', 'No', 'Si', 'No', 'Si', 'Si', 'No', 'No', 'No', 'Si', 'No', 'Si', 'Si', 'Si', 'Si', 'Si'),
(6, 'aux_cotizacion', 'No', 'No', 'No', 'Si', 'Si', 'No', 'No', 'Si', 'No', 'No', 'Si', 'Si', 'Si', 'Si', 'Si'),
(7, 'aux_contable', 'No', 'No', 'No', 'Si', 'Si', 'No', 'Si', 'No', 'No', 'No', 'No', 'Si', 'Si', 'Si', 'Si'),
(8, 'admin_contable', 'No', 'Si', 'No', 'Si', 'Si', 'No', 'Si', 'No', 'Si', 'No', 'Si', 'Si', 'Si', 'Si', 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text DEFAULT NULL,
  `apellidos_usuario` varchar(100) DEFAULT NULL,
  `correo_usuario` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `perfil` int(11) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `id_cargo_fk` int(11) DEFAULT NULL,
  `id_proceso_fk` int(11) DEFAULT NULL,
  `ultimo_login` datetime DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `intentos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos_usuario`, `correo_usuario`, `password`, `perfil`, `foto`, `estado`, `id_cargo_fk`, `id_proceso_fk`, `ultimo_login`, `fecha`, `intentos`) VALUES
(1, 'Stefania', 'Sierra Loaiza', 'ssierra@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 3, '', 1, 9, 7, NULL, '2024-09-04 17:08:01', NULL),
(2, 'Yuliana Melissa', 'Montoya', 'ymontoyag@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 5, 'vistas/img/usuarios/firmas/firma_yaque.png', 1, 1, 2, '2025-01-16 07:51:48', '2024-09-04 17:08:01', 2),
(3, 'Jorge Eliecer', 'Garcia Cardona', 'jcardona@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 3, '', 1, 9, 7, NULL, '2024-09-04 17:08:01', NULL),
(4, 'Santiago', 'Bermudez Marin', 'sbermudez@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 5, '', 1, 14, 11, NULL, '2024-09-04 17:08:01', NULL),
(5, 'Santiago', 'Rendon', 'mensajeria@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 3, '', 1, 11, 5, NULL, '2024-09-04 17:08:01', NULL),
(6, 'Sonia Janeth', 'Salazar Oviedo ', 'ssalazar@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 8, '65b28277c9bac_Captura de pantalla 2023-11-22 152319.png', 1, 12, 3, NULL, '2024-09-04 17:08:01', NULL),
(7, 'Aura Maria', 'Ledesma', 'aledesma@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 5, '6674480a1f9a1_aura.jpg', 1, 7, 7, NULL, '2024-09-04 17:08:01', NULL),
(8, 'Oscar Julian', 'Millan Rodas', 'auxiliarsst@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 3, '', 1, 3, 9, NULL, '2024-09-04 17:08:01', NULL),
(9, 'Monitoreo', 'ZFIP', 'monitoreo@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 3, '', 1, 18, 8, NULL, '2024-09-04 17:08:01', NULL),
(10, 'Yaqueline', 'Garcia Zapata', 'ygarciaz@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 3, 'vistas/img/usuarios/firmas/firma_yaque.png', 1, 2, 2, '2024-10-29 09:49:44', '2024-09-04 17:08:01', NULL),
(11, 'Andrea ', 'Galan Moreno', 'agalan@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 4, '6595b34b5ce72_firma.jpg', 1, 19, 10, NULL, '2024-09-04 17:08:01', NULL),
(12, 'Isabel Cristina', 'Bustamante', 'cbustamante@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 6, '', 1, 5, 5, NULL, '2024-09-04 17:08:01', NULL),
(13, 'Estefania', 'Velasquez', 'evelasquez@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 3, '', 1, 20, 5, NULL, '2024-09-04 17:08:01', NULL),
(14, 'Bayron Julian', 'Parra Gomez ', 'bparra@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 5, '6595ce752d918_FIRMA BP OC.png', 1, 15, 4, NULL, '2024-09-04 17:08:01', NULL),
(15, 'Faisury', 'Gomez Serna', 'fgomezs@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 3, '', 1, 10, 7, NULL, '2024-09-04 17:08:01', NULL),
(16, 'Juan Carlos', 'Perez Rodas', 'jperez@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 5, '', 1, 8, 7, NULL, '2024-09-04 17:08:01', NULL),
(17, 'Yuly Viviana', 'Rios Castaño', 'yrios@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 2, '66478bd97849c_Firma.jpg', 1, 4, 1, NULL, '2024-09-04 17:08:01', NULL),
(18, 'Sebastian', 'Erazo Aguirre', 'serazo@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 3, '', 1, 9, 7, NULL, '2024-09-04 17:08:01', NULL),
(19, 'Jennifer Alexandra', 'Villada Gonzales', 'practicantesig@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 3, '', 1, 21, 9, NULL, '2024-09-04 17:08:01', NULL),
(20, 'Robert Arturo', 'Soto Velez', 'rsoto@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 3, '', 1, 9, 7, NULL, '2024-09-04 17:08:01', NULL),
(21, 'Julio', 'Raigosa', 'jraigosa@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 3, '', 1, 1, 8, NULL, '2024-09-04 17:08:01', NULL),
(22, 'Yuliana Andrea', 'Lopez Taborda', 'ylopez@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 7, '', 1, 13, 3, NULL, '2024-09-04 17:08:01', NULL),
(23, 'Julian Bernardo', 'Gutierrez Naranjo', 'jgutierrez@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 3, '', 1, 9, 7, NULL, '2024-09-04 17:08:01', NULL),
(24, 'Maria Valentina', 'Alvarez Gallego', 'malvarez@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 5, '6661e250b109f_WhatsApp_Image_2024-04-06_at_08.51.09-removebg-preview (2).png', 1, 14, 11, '2024-10-29 10:50:45', '2024-09-04 17:08:01', NULL),
(25, 'Mateo', 'Rios', 'gerencia@creserconsultores.com.co', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 3, '', 1, 5, 5, NULL, '2024-09-04 17:08:01', NULL),
(26, 'Ana Luisa', ' Lagos Pati¤o', 'alagos@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 3, '', 1, 9, 7, NULL, '2024-09-04 17:08:01', NULL),
(27, 'GAD - Cristian', 'Benavides', 'diradministrativo@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 5, '65df9d2780fb0_FIRMA CEBG.jpeg', 1, 6, 5, NULL, '2024-09-04 17:08:01', NULL),
(28, 'Kevin David', 'Echavarria Gonzalez', 'kechavarria@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 3, '', 1, 9, 7, NULL, '2024-09-04 17:08:01', NULL),
(56, 'Maria Nancy', 'Gonzales', 'serviciosgenerales@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 3, '', 1, 5, 5, NULL, '2024-09-04 17:08:01', NULL),
(57, 'inactivo', '2024', 'inactivos@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 5, '', 1, 1, 2, NULL, '2024-09-04 17:08:01', NULL),
(58, 'Nicol Camila', 'Mora Guasca', 'nmora@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 3, '', 1, 10, 7, NULL, '2024-09-04 17:08:01', NULL),
(59, 'SEG - Cristian ', 'Benavides', 'diradministrativo@zonafrancadepereira.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 5, '', 1, 22, 13, NULL, '2024-09-04 17:08:01', NULL),
(60, 'Super', 'Administrador', 'admin@zonafrancadepereira.com', '85$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG23', 1, '', 1, 1, 2, NULL, '2024-09-04 17:08:01', NULL),
(1087561072, 'Estefania ', 'Colorado', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 1, 'vistas/img/usuarios/firmas/firma_yaque.png', 1, 1, 2, '2025-01-16 17:04:48', '2024-09-04 19:04:00', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vencimiento_acpm`
--

CREATE TABLE `vencimiento_acpm` (
  `id_notificacion` int(11) NOT NULL,
  `id_acpm_fk` int(11) NOT NULL,
  `fecha_vencimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `verificaciones`
--

CREATE TABLE `verificaciones` (
  `id_verificacion` int(11) NOT NULL,
  `id_inventario_fk` int(11) NOT NULL,
  `id_activo_fk` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `estado` enum('Bueno','Dar de Baja','Perdido') NOT NULL,
  `observaciones` text DEFAULT NULL,
  `fecha_verificacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `verificaciones`
--

INSERT INTO `verificaciones` (`id_verificacion`, `id_inventario_fk`, `id_activo_fk`, `id_usuario_fk`, `estado`, `observaciones`, `fecha_verificacion`) VALUES
(25, 15, 182336, 1, 'Dar de Baja', 'Se daño en la inundacion', '2024-07-10 21:17:20'),
(27, 15, 182326, 1, 'Bueno', 'Varificado\r\n', '2024-07-11 13:05:20'),
(28, 15, 182327, 1, 'Bueno', '', '2024-07-11 13:05:37'),
(29, 15, 182335, 1, 'Perdido', '', '2024-07-11 13:30:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `version_documentos`
--

CREATE TABLE `version_documentos` (
  `id_documento` int(11) NOT NULL,
  `codigo_documento` varchar(50) NOT NULL,
  `nombre_documento` varchar(200) NOT NULL,
  `fecha_implementacion` date NOT NULL,
  `fecha_actualizacion` date NOT NULL,
  `version_documento` int(11) NOT NULL,
  `responsable_recoleccion` varchar(300) NOT NULL,
  `ruta_almacenamiento` text NOT NULL,
  `clasificacion_documento` text NOT NULL,
  `ordenacion_documento` varchar(50) NOT NULL,
  `responsable_administracion` varchar(300) NOT NULL,
  `acceso_permitido` text NOT NULL,
  `ag` varchar(11) NOT NULL,
  `ac` varchar(11) NOT NULL,
  `e` varchar(11) NOT NULL,
  `s` varchar(11) NOT NULL,
  `ct` varchar(11) NOT NULL,
  `md` varchar(11) NOT NULL,
  `id_proceso_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `version_documentos`
--

INSERT INTO `version_documentos` (`id_documento`, `codigo_documento`, `nombre_documento`, `fecha_implementacion`, `fecha_actualizacion`, `version_documento`, `responsable_recoleccion`, `ruta_almacenamiento`, `clasificacion_documento`, `ordenacion_documento`, `responsable_administracion`, `acceso_permitido`, `ag`, `ac`, `e`, `s`, `ct`, `md`, `id_proceso_fk`) VALUES
(1, 'FO-OP-01-PR-07', 'ACTA DE INSPECCION DE MERCANCIAS', '2017-08-10', '2018-07-26', 5, 'Director de Operaciones', 'Registro Físico: Archivo Operaciones\n\nFormato en Blanco: SADOC - Gestión de Operaciones - Formatos', 'Documento de origen interno (Formato)', 'Por Consecutivo y Fecha', 'Dirección de Operaciones', 'Gerencia y Proceso operaciones', '1', '4', '', '', 'X', 'X', 7),
(2, 'FO-TI-02', 'MANTENIMIENTO PREVENTIVO', '2017-06-06', '2023-07-24', 7, 'Coordinador de T.I', 'Registro Físico Carpeta mantenimiento preventivo/archivo físico T.I\r\n\r\nFormato en Blanco: SADOC - Gestión TI - Formatos ', 'Documento de origen interno (Formato)', 'Por Fecha', 'Coordinador de T.I', 'Auxiliar TI', '3', '3', 'X', '', '', '', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acpm`
--
ALTER TABLE `acpm`
  ADD PRIMARY KEY (`id_consecutivo`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`);

--
-- Indices de la tabla `acpm_rechazada`
--
ALTER TABLE `acpm_rechazada`
  ADD PRIMARY KEY (`id_rechazada`),
  ADD KEY `id_consecutivo_fk` (`id_consecutivo_fk`);

--
-- Indices de la tabla `actividades_acpm`
--
ALTER TABLE `actividades_acpm`
  ADD PRIMARY KEY (`id_actividad`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`),
  ADD KEY `id_acpm_fk` (`id_acpm_fk`);

--
-- Indices de la tabla `activos`
--
ALTER TABLE `activos`
  ADD PRIMARY KEY (`id_activo`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`),
  ADD KEY `id_proveedor` (`id_proveedor_fk`);

--
-- Indices de la tabla `actualizacion_pw`
--
ALTER TABLE `actualizacion_pw`
  ADD PRIMARY KEY (`id_pw`);

--
-- Indices de la tabla `asignacion_equipos`
--
ALTER TABLE `asignacion_equipos`
  ADD PRIMARY KEY (`id_asignacion`),
  ADD KEY `id_ti_fk` (`id_ti_fk`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`);

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `categoria_op`
--
ALTER TABLE `categoria_op`
  ADD PRIMARY KEY (`id_categoriaop`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes_zfip`
--
ALTER TABLE `clientes_zfip`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `compras_consumibles`
--
ALTER TABLE `compras_consumibles`
  ADD PRIMARY KEY (`id_consumible`),
  ADD KEY `tipo_consumible` (`tipo_consumible`);

--
-- Indices de la tabla `consumibles`
--
ALTER TABLE `consumibles`
  ADD PRIMARY KEY (`id_tipo_consumible`);

--
-- Indices de la tabla `copias_seguridad`
--
ALTER TABLE `copias_seguridad`
  ADD PRIMARY KEY (`id_backup`),
  ADD KEY `id_usuario_backup_fk` (`id_usuario_backup_fk`);

--
-- Indices de la tabla `detalles_equipos`
--
ALTER TABLE `detalles_equipos`
  ADD PRIMARY KEY (`id_asignacion`),
  ADD KEY `id_activo_fk` (`id_activo_fk`);

--
-- Indices de la tabla `detalle_actividad`
--
ALTER TABLE `detalle_actividad`
  ADD PRIMARY KEY (`id_detalle_acpm`),
  ADD KEY `id_actividad_fk` (`id_actividad_fk`,`id_usuario_e_fk`),
  ADD KEY `id_usuario_e_fk` (`id_usuario_e_fk`);

--
-- Indices de la tabla `detalle_codificacion`
--
ALTER TABLE `detalle_codificacion`
  ADD PRIMARY KEY (`id_codificacion`),
  ADD KEY `id_solicitud_codificacion` (`id_codificacion_fk`);

--
-- Indices de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  ADD PRIMARY KEY (`id_orden_detalle`);

--
-- Indices de la tabla `detalle_pw`
--
ALTER TABLE `detalle_pw`
  ADD PRIMARY KEY (`id_detalle_pw`);

--
-- Indices de la tabla `historial_transferencias`
--
ALTER TABLE `historial_transferencias`
  ADD PRIMARY KEY (`id_transferencia`);

--
-- Indices de la tabla `impresoras`
--
ALTER TABLE `impresoras`
  ADD PRIMARY KEY (`id_impresora`);

--
-- Indices de la tabla `inspeccion_op`
--
ALTER TABLE `inspeccion_op`
  ADD PRIMARY KEY (`id_inspeccion`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`),
  ADD KEY `id_usuario_apertura` (`id_usuario_apertura`),
  ADD KEY `id_usuario_cierre` (`id_usuario_cierre`);

--
-- Indices de la tabla `mantenimientos`
--
ALTER TABLE `mantenimientos`
  ADD PRIMARY KEY (`id_mantenimiento`),
  ADD KEY `mantenimientos_ibfk_1` (`id_usuario_fk`);

--
-- Indices de la tabla `mantenimiento_general`
--
ALTER TABLE `mantenimiento_general`
  ADD PRIMARY KEY (`id_general`),
  ADD KEY `mantenimiento_general_ibfk_1` (`id_usuario_fk3`);

--
-- Indices de la tabla `mantenimiento_impresora`
--
ALTER TABLE `mantenimiento_impresora`
  ADD PRIMARY KEY (`id_impresora`),
  ADD KEY `id_usuario_fk2` (`id_usuario_fk2`);

--
-- Indices de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD PRIMARY KEY (`id_orden`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`perfil`);

--
-- Indices de la tabla `proceso`
--
ALTER TABLE `proceso`
  ADD PRIMARY KEY (`id_proceso`);

--
-- Indices de la tabla `proveedor_compras`
--
ALTER TABLE `proveedor_compras`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`);

--
-- Indices de la tabla `registro_consumible`
--
ALTER TABLE `registro_consumible`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `id_impresora_fk` (`id_impresora_fk`),
  ADD KEY `id_tipo_consumible_fk` (`id_tipo_consumible_fk`);

--
-- Indices de la tabla `sadoc`
--
ALTER TABLE `sadoc`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud_codificacion`
--
ALTER TABLE `solicitud_codificacion`
  ADD PRIMARY KEY (`id_codificacion`);

--
-- Indices de la tabla `soporte`
--
ALTER TABLE `soporte`
  ADD PRIMARY KEY (`id_soporte`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`);

--
-- Indices de la tabla `soporte_juridico`
--
ALTER TABLE `soporte_juridico`
  ADD PRIMARY KEY (`id_soporte_juridico`),
  ADD KEY `id_cargo_fk1` (`id_cargo_fk1`),
  ADD KEY `id_proceso_fk1` (`id_proceso_fk1`),
  ADD KEY `nombre_solicitante` (`nombre_solicitante`);

--
-- Indices de la tabla `soporte_tecnico`
--
ALTER TABLE `soporte_tecnico`
  ADD PRIMARY KEY (`id_soporte_tecnico`),
  ADD KEY `id_usuario_fk1` (`id_usuario_fk1`),
  ADD KEY `proceso_fk1` (`proceso_fk1`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cargo_fk` (`id_cargo_fk`),
  ADD KEY `id_proceso_fk` (`id_proceso_fk`);

--
-- Indices de la tabla `vencimiento_acpm`
--
ALTER TABLE `vencimiento_acpm`
  ADD PRIMARY KEY (`id_notificacion`);

--
-- Indices de la tabla `verificaciones`
--
ALTER TABLE `verificaciones`
  ADD PRIMARY KEY (`id_verificacion`);

--
-- Indices de la tabla `version_documentos`
--
ALTER TABLE `version_documentos`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `id_proceso_fk` (`id_proceso_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acpm`
--
ALTER TABLE `acpm`
  MODIFY `id_consecutivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `acpm_rechazada`
--
ALTER TABLE `acpm_rechazada`
  MODIFY `id_rechazada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `actividades_acpm`
--
ALTER TABLE `actividades_acpm`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `activos`
--
ALTER TABLE `activos`
  MODIFY `id_activo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182342;

--
-- AUTO_INCREMENT de la tabla `actualizacion_pw`
--
ALTER TABLE `actualizacion_pw`
  MODIFY `id_pw` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `categoria_op`
--
ALTER TABLE `categoria_op`
  MODIFY `id_categoriaop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `compras_consumibles`
--
ALTER TABLE `compras_consumibles`
  MODIFY `id_consumible` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `consumibles`
--
ALTER TABLE `consumibles`
  MODIFY `id_tipo_consumible` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `copias_seguridad`
--
ALTER TABLE `copias_seguridad`
  MODIFY `id_backup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detalle_actividad`
--
ALTER TABLE `detalle_actividad`
  MODIFY `id_detalle_acpm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `detalle_codificacion`
--
ALTER TABLE `detalle_codificacion`
  MODIFY `id_codificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  MODIFY `id_orden_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_pw`
--
ALTER TABLE `detalle_pw`
  MODIFY `id_detalle_pw` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `historial_transferencias`
--
ALTER TABLE `historial_transferencias`
  MODIFY `id_transferencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `impresoras`
--
ALTER TABLE `impresoras`
  MODIFY `id_impresora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `inspeccion_op`
--
ALTER TABLE `inspeccion_op`
  MODIFY `id_inspeccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `mantenimientos`
--
ALTER TABLE `mantenimientos`
  MODIFY `id_mantenimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `mantenimiento_general`
--
ALTER TABLE `mantenimiento_general`
  MODIFY `id_general` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `mantenimiento_impresora`
--
ALTER TABLE `mantenimiento_impresora`
  MODIFY `id_impresora` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  MODIFY `id_orden` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `proceso`
--
ALTER TABLE `proceso`
  MODIFY `id_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `registro_consumible`
--
ALTER TABLE `registro_consumible`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sadoc`
--
ALTER TABLE `sadoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `solicitud_codificacion`
--
ALTER TABLE `solicitud_codificacion`
  MODIFY `id_codificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `soporte`
--
ALTER TABLE `soporte`
  MODIFY `id_soporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT de la tabla `soporte_juridico`
--
ALTER TABLE `soporte_juridico`
  MODIFY `id_soporte_juridico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `soporte_tecnico`
--
ALTER TABLE `soporte_tecnico`
  MODIFY `id_soporte_tecnico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1087561074;

--
-- AUTO_INCREMENT de la tabla `vencimiento_acpm`
--
ALTER TABLE `vencimiento_acpm`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `verificaciones`
--
ALTER TABLE `verificaciones`
  MODIFY `id_verificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `version_documentos`
--
ALTER TABLE `version_documentos`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acpm`
--
ALTER TABLE `acpm`
  ADD CONSTRAINT `acpm_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `acpm_rechazada`
--
ALTER TABLE `acpm_rechazada`
  ADD CONSTRAINT `acpm_rechazada_ibfk_1` FOREIGN KEY (`id_consecutivo_fk`) REFERENCES `acpm` (`id_consecutivo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `actividades_acpm`
--
ALTER TABLE `actividades_acpm`
  ADD CONSTRAINT `actividades_acpm_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `actividades_acpm_ibfk_2` FOREIGN KEY (`id_acpm_fk`) REFERENCES `acpm` (`id_consecutivo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `compras_consumibles`
--
ALTER TABLE `compras_consumibles`
  ADD CONSTRAINT `compras_consumibles_ibfk_1` FOREIGN KEY (`tipo_consumible`) REFERENCES `consumibles` (`id_tipo_consumible`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `copias_seguridad`
--
ALTER TABLE `copias_seguridad`
  ADD CONSTRAINT `copias_seguridad_ibfk_1` FOREIGN KEY (`id_usuario_backup_fk`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_actividad`
--
ALTER TABLE `detalle_actividad`
  ADD CONSTRAINT `detalle_actividad_ibfk_1` FOREIGN KEY (`id_actividad_fk`) REFERENCES `actividades_acpm` (`id_actividad`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_actividad_ibfk_2` FOREIGN KEY (`id_usuario_e_fk`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_codificacion`
--
ALTER TABLE `detalle_codificacion`
  ADD CONSTRAINT `detalle_codificacion_ibfk_1` FOREIGN KEY (`id_codificacion_fk`) REFERENCES `solicitud_codificacion` (`id_codificacion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`id_usuario_apertura`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`id_usuario_cierre`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `mantenimientos`
--
ALTER TABLE `mantenimientos`
  ADD CONSTRAINT `mantenimientos_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mantenimiento_general`
--
ALTER TABLE `mantenimiento_general`
  ADD CONSTRAINT `mantenimiento_general_ibfk_1` FOREIGN KEY (`id_usuario_fk3`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `mantenimiento_impresora`
--
ALTER TABLE `mantenimiento_impresora`
  ADD CONSTRAINT `mantenimiento_impresora_ibfk_1` FOREIGN KEY (`id_usuario_fk2`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `registro_consumible`
--
ALTER TABLE `registro_consumible`
  ADD CONSTRAINT `registro_consumible_ibfk_1` FOREIGN KEY (`id_impresora_fk`) REFERENCES `impresoras` (`id_impresora`) ON UPDATE CASCADE,
  ADD CONSTRAINT `registro_consumible_ibfk_2` FOREIGN KEY (`id_tipo_consumible_fk`) REFERENCES `consumibles` (`id_tipo_consumible`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `soporte`
--
ALTER TABLE `soporte`
  ADD CONSTRAINT `soporte_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `soporte_juridico`
--
ALTER TABLE `soporte_juridico`
  ADD CONSTRAINT `soporte_juridico_ibfk_1` FOREIGN KEY (`id_cargo_fk1`) REFERENCES `cargos` (`id_cargo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `soporte_juridico_ibfk_2` FOREIGN KEY (`id_proceso_fk1`) REFERENCES `proceso` (`id_proceso`) ON UPDATE CASCADE,
  ADD CONSTRAINT `soporte_juridico_ibfk_3` FOREIGN KEY (`nombre_solicitante`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `soporte_tecnico`
--
ALTER TABLE `soporte_tecnico`
  ADD CONSTRAINT `soporte_tecnico_ibfk_1` FOREIGN KEY (`proceso_fk1`) REFERENCES `proceso` (`id_proceso`) ON UPDATE CASCADE,
  ADD CONSTRAINT `soporte_tecnico_ibfk_2` FOREIGN KEY (`id_usuario_fk1`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_cargo_fk`) REFERENCES `cargos` (`id_cargo`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_proceso_fk`) REFERENCES `proceso` (`id_proceso`) ON DELETE CASCADE;

--
-- Filtros para la tabla `version_documentos`
--
ALTER TABLE `version_documentos`
  ADD CONSTRAINT `version_documentos_ibfk_3` FOREIGN KEY (`id_proceso_fk`) REFERENCES `proceso` (`id_proceso`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
