--
-- Data for Name: result_lookups; Type: TABLE DATA; Schema: public; Owner: -
--

COPY result_lookups (id, test_id, value, description, comment, user_id, modified) FROM stdin;
1	1	A	Arrived		1	2009-07-19 22:38:09
2	1	BS	Being Seen		1	2009-07-19 22:38:21
3	1	S	Seen		1	2009-07-19 22:38:59
4	5	N	No		1	2009-07-19 22:41:43
5	5	Y	Yes		1	2009-07-19 22:42:04
6	7	Y	Yes		1	2009-07-19 22:44:48
7	7	N	No		1	2009-07-19 22:44:58
8	8	1	No Signs		1	2009-07-19 22:46:21
9	8	2	TB Suspected		1	2009-07-19 22:46:31
10	8	3	Receiving TB Treatment		1	2009-07-19 22:46:45
11	9	1	Herpes Zoster		1	2009-07-19 22:48:32
12	9	2	Pneumonia		1	2009-07-19 22:48:41
13	9	3	Dementia/Encephalitis		1	2009-07-19 22:48:55
14	9	4	Thrush - Oral/Vaginal		1	2009-07-19 22:49:36
15	9	5	Ulcers - Mouth, etc.		1	2009-07-19 22:51:10
16	9	6	Fever		1	2009-07-19 22:51:20
17	9	7	Cough		1	2009-07-19 22:51:28
18	9	8	Difficulty Breathing		1	2009-07-19 22:51:39
19	9	9	IRIS (Immune Reconstitution Inflammatory Syndrome)		1	2009-07-19 22:52:00
20	9	10	Weight Loss		1	2009-07-19 22:52:10
21	9	11	Urethral Discharge		1	2009-07-19 22:52:19
22	9	12	PID (Pelvic Inflammatory Disease)		1	2009-07-19 22:52:32
23	9	13	GUD (Genital Ulcerative Disease)		1	2009-07-19 22:52:48
24	10	1	Peripheral Neuropathy		1	2009-07-19 22:53:46
25	10	2	Rash		1	2009-07-19 22:53:53
26	10	3	Anaemia		1	2009-07-19 22:54:00
27	10	4	Pancreatitis		1	2009-07-19 22:54:09
28	10	5	Jaundice		1	2009-07-19 22:54:19
29	10	6	Fat Redistribution		1	2009-07-19 22:54:31
30	10	7	Hypersensitivity		1	2009-07-19 22:54:41
31	10	8	Hepatotoxicity		1	2009-07-19 22:54:51
32	10	9	CNS Symptoms (Dizziness, Anxiety, Depression)		1	2009-07-19 22:55:10
33	11	YS	Yes (Satisfactory Adherence)		1	2009-07-19 22:56:30
34	11	YU	Yes (Unsatisfactory Adherence)		1	2009-07-19 22:56:46
35	11	N	No		1	2009-07-19 22:56:54
36	12	YS	Yes (Satisfactory Adherence)		1	2009-07-19 22:57:34
37	12	YU	Yes (Unsatisfactory Adherence)		1	2009-07-19 22:57:46
38	12	N	No		1	2009-07-19 22:58:04
39	14	0	Unknown		1	2009-07-19 22:59:52
40	15	YS	Yes (Satisfactory Adherence)		1	2009-07-19 23:00:35
41	15	YU	Yes (Unsatisfactory Adherence)		1	2009-07-19 23:00:44
42	15	N	No		1	2009-07-19 23:00:52
43	20	0	Unknown		1	2009-07-19 23:04:20
\.

--
-- Data for Name: tests; Type: TABLE DATA; Schema: public; Owner: -
--

COPY tests (id, name, abbreiviation, type, upper_limit, lower_limit, description, comment, active, user_id, modified, units) FROM stdin;
1	Clinic Attendance	Attendance	lookup	\N	\N	A record of a patient's clinic attendance		t	1	2009-07-19 22:37:59	
2	Weight	Wt	decimal	\N	\N	The patient's current weight in kilograms.		t	1	2009-07-19 22:39:59	kg
3	Height	Ht	decimal	\N	\N	The patient's current height in metres.		t	1	2009-07-19 22:40:22	m
4	Temperature	Temp	decimal	\N	\N	The patient's temperature in degrees Celsius.		t	1	2009-07-19 22:41:10	ºC
5	Pregnant		lookup	\N	\N	Is the patient currently pregnant?		t	1	2009-07-19 22:41:32	
6	Last Menstrual Period	LMP	text	\N	\N	Date of the patient's last menstrual period in the format DD-MM-YYYY		t	1	2009-07-19 22:43:46	
7	Family Planning Status		lookup	\N	\N	Is the patient using any form of contraception?		t	1	2009-07-19 22:44:36	
8	TB Status		lookup	\N	\N	The current TB status of the patient.		t	1	2009-07-19 22:46:10	
9	New Opportunistic Infection or Other Medical Conditions	NewOI	lookup	\N	\N	Does the patient have a new opportunistic infection or other medical condition?		t	1	2009-07-19 22:48:23	
10	ART Side Effects	ART SE	lookup	\N	\N	Is the patient currently experiencing any side-effects of ARTs?		t	1	2009-07-19 22:53:32	
11	Cotrimoxazole Status		lookup	\N	\N	Is the patient taking cotrimoxazole?		t	1	2009-07-19 22:56:15	
12	Fluconazole Status		lookup	\N	\N	Is the patient taking fluconazole?		t	1	2009-07-19 22:57:27	
13	Other Medications Dispensed		text	\N	\N	Have any other medications been dispensed to the patient?		t	1	2009-07-19 22:58:40	
14	ARV Drug Regimen		lookup	\N	\N			f	1	2009-07-19 22:59:43	
15	ARV Drug Status		lookup	\N	\N			t	1	2009-07-19 23:00:28	
16	CD4 Count	CD4	decimal	\N	\N	The patient's current CD4 count.		t	1	2009-07-19 23:01:45	%
17	Haemaglobin	Hb	decimal	\N	\N	The patient's current haemaglobin level.		t	1	2009-07-19 23:02:16	g/dL
18	White Cell Count	WCC	decimal	\N	\N	The patient's current white cell count.		t	1	2009-07-19 23:03:10	x10^9
19	ALT	ALT	decimal	\N	\N			t	1	2009-07-19 23:03:50	IU
20	Referred To		lookup	\N	\N			f	1	2009-07-19 23:04:13	
21	Date of Next Appointment		text	\N	\N	The date of the patient's next appointment in the format DD-MM-YYYY		t	1	2009-07-19 23:05:12	
22	Clinical Note		text	\N	\N			t	1	2009-07-19 23:05:44	
23	Examination Findings		text	\N	\N			t	1	2009-07-19 23:05:58	
\.
