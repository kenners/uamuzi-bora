--
-- PostgreSQL database dump
--

SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

ALTER TABLE ONLY public.vf_testing_sites DROP CONSTRAINT vf_testing_sites_location_id_fkey;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_vf_testing_site_fkey;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_occupation_id_fkey;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_marital_status_id_fkey;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_location_id_fkey;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_education_id_fkey;
DROP INDEX public.aro_aco_key;
ALTER TABLE ONLY public.vf_testing_sites DROP CONSTRAINT vf_testing_sites_site_name_key;
ALTER TABLE ONLY public.vf_testing_sites DROP CONSTRAINT vf_testing_sites_pkey;
ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
ALTER TABLE ONLY public.tests DROP CONSTRAINT tests_pkey;
ALTER TABLE ONLY public.results DROP CONSTRAINT results_pkey;
ALTER TABLE ONLY public.result_lookups DROP CONSTRAINT result_lookups_pkey;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_vfcc_key;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_upn_key;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_pkey;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_arvid_key;
ALTER TABLE ONLY public.occupations DROP CONSTRAINT occupations_pkey;
ALTER TABLE ONLY public.occupations DROP CONSTRAINT occupations_name_key;
ALTER TABLE ONLY public.marital_statuses DROP CONSTRAINT marital_statuses_pkey;
ALTER TABLE ONLY public.marital_statuses DROP CONSTRAINT marital_statuses_name_key;
ALTER TABLE ONLY public.locations DROP CONSTRAINT locations_pkey;
ALTER TABLE ONLY public.groups DROP CONSTRAINT groups_pkey;
ALTER TABLE ONLY public.educations DROP CONSTRAINT educations_pkey;
ALTER TABLE ONLY public.educations DROP CONSTRAINT educations_name_key;
ALTER TABLE ONLY public.aros DROP CONSTRAINT aros_pkey;
ALTER TABLE ONLY public.aros_acos DROP CONSTRAINT aros_acos_pkey;
ALTER TABLE ONLY public.archive_results DROP CONSTRAINT archive_results_pkey;
ALTER TABLE ONLY public.acos DROP CONSTRAINT acos_pkey;
ALTER TABLE public.vf_testing_sites ALTER COLUMN site_code DROP DEFAULT;
ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.tests ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.results ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.result_lookups ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.occupations ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.marital_statuses ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.locations ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.groups ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.educations ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.aros_acos ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.aros ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.archive_results ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.acos ALTER COLUMN id DROP DEFAULT;
DROP SEQUENCE public.vf_testing_sites_site_code_seq;
DROP TABLE public.vf_testing_sites;
DROP SEQUENCE public.users_id_seq;
DROP TABLE public.users;
DROP SEQUENCE public.tests_tid_seq;
DROP SEQUENCE public.tests_id_seq;
DROP TABLE public.tests;
DROP SEQUENCE public.results_id_seq;
DROP TABLE public.results;
DROP SEQUENCE public.result_lookups_id_seq;
DROP TABLE public.result_lookups;
DROP TABLE public.patients;
DROP SEQUENCE public.occupations_id_seq;
DROP TABLE public.occupations;
DROP SEQUENCE public.marital_statuses_id_seq;
DROP TABLE public.marital_statuses;
DROP SEQUENCE public.locations_id_seq;
DROP TABLE public.locations;
DROP SEQUENCE public.groups_id_seq;
DROP TABLE public.groups;
DROP SEQUENCE public.educations_id_seq;
DROP TABLE public.educations;
DROP SEQUENCE public.aros_id_seq;
DROP SEQUENCE public.aros_acos_id_seq;
DROP TABLE public.aros_acos;
DROP TABLE public.aros;
DROP SEQUENCE public.archive_results_id_seq;
DROP TABLE public.archive_results;
DROP SEQUENCE public.acos_id_seq;
DROP TABLE public.acos;
DROP PROCEDURAL LANGUAGE plpgsql;
DROP SCHEMA public;
--
-- Name: public; Type: SCHEMA; Schema: -; Owner: -
--

CREATE SCHEMA public;


--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- Name: plpgsql; Type: PROCEDURAL LANGUAGE; Schema: -; Owner: -
--

CREATE PROCEDURAL LANGUAGE plpgsql;


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;


--
-- Name: archive_results; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE archive_results (
    id integer NOT NULL,
    user_id integer NOT NULL,
    created timestamp without time zone,
    archive_reason character varying,
    archive_id integer NOT NULL,
    archive_pid integer NOT NULL,
    archive_test_id integer NOT NULL,
    archive_value_decimal double precision,
    archive_value_text character varying,
    archive_value_lookup character varying,
    archive_test_performed timestamp without time zone,
    archive_created timestamp without time zone,
    archive_requesting_clinician character varying,
    archive_user_id integer NOT NULL
);


--
-- Name: archive_results_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE archive_results_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: archive_results_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE archive_results_id_seq OWNED BY archive_results.id;

--
-- Name: educations; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE educations (
    id integer NOT NULL,
    name character varying NOT NULL,
    description character varying,
    comment character varying
);


--
-- Name: educations_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE educations_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: educations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE educations_id_seq OWNED BY educations.id;


--
-- Name: educations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('educations_id_seq', 3, true);


--
-- Name: groups; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE groups (
    id integer NOT NULL,
    name character varying,
    description character varying,
    created timestamp without time zone,
    modified timestamp without time zone
);


--
-- Name: groups_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE groups_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: groups_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE groups_id_seq OWNED BY groups.id;


--
-- Name: groups_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('groups_id_seq', 2, true);


--
-- Name: locations; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE locations (
    id integer NOT NULL,
    name character varying NOT NULL,
    parent_id integer,
    tree_left integer,
    tree_right integer,
    vf_code integer,
    longitude double precision,
    latitude double precision,
    description character varying,
    comment character varying
);


--
-- Name: locations_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE locations_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: locations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE locations_id_seq OWNED BY locations.id;


--
-- Name: locations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('locations_id_seq', 43, true);


--
-- Name: marital_statuses; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE marital_statuses (
    id integer NOT NULL,
    name character varying NOT NULL,
    description character varying,
    comment character varying
);


--
-- Name: marital_statuses_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE marital_statuses_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: marital_statuses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE marital_statuses_id_seq OWNED BY marital_statuses.id;


--
-- Name: marital_statuses_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('marital_statuses_id_seq', 5, true);


--
-- Name: occupations; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE occupations (
    id integer NOT NULL,
    name character varying NOT NULL,
    description character varying,
    comment character varying
);


--
-- Name: occupations_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE occupations_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: occupations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE occupations_id_seq OWNED BY occupations.id;


--
-- Name: occupations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('occupations_id_seq', 4, true);


--
-- Name: patients; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE patients (
    pid integer NOT NULL,
    upn integer,
    arvid integer,
    vfcc integer,
    surname character varying NOT NULL,
    forenames character varying NOT NULL,
    date_of_birth date,
    year_of_birth integer NOT NULL,
    sex character varying,
    mother text,
    occupation_id integer,
    education_id integer,
    marital_status_id integer,
    telephone_number character varying,
    treatment_supporter text,
    location_id integer,
    village character varying,
    home character varying,
    nearest_church character varying,
    nearest_school character varying,
    nearest_health_centre character varying,
    nearest_major_landmark character varying,
    vf_testing_site integer
);


--
-- Name: result_lookups; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE result_lookups (
    id integer NOT NULL,
    test_id integer NOT NULL,
    value character varying NOT NULL,
    description character varying,
    comment character varying,
    user_id integer NOT NULL,
    modified timestamp without time zone NOT NULL
);


--
-- Name: result_lookups_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE result_lookups_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: result_lookups_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE result_lookups_id_seq OWNED BY result_lookups.id;


--
-- Name: result_lookups_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('result_lookups_id_seq', 1, true);


--
-- Name: results; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE results (
    id integer NOT NULL,
    pid integer NOT NULL,
    test_id integer NOT NULL,
    value_decimal double precision,
    value_text character varying,
    value_lookup character varying,
    test_performed timestamp without time zone,
    created timestamp without time zone,
    requesting_clinician character varying,
    user_id integer NOT NULL
);


--
-- Name: results_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE results_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: results_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE results_id_seq OWNED BY results.id;



--
-- Name: tests; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE tests (
    id integer NOT NULL,
    name character varying NOT NULL,
    abbreiviation character varying,
    type character varying NOT NULL,
    upper_limit double precision,
    lower_limit double precision,
    description character varying,
    comment character varying,
    active boolean DEFAULT true,
    user_id integer NOT NULL,
    modified timestamp without time zone NOT NULL
);


--
-- Name: tests_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE tests_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: tests_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE tests_id_seq OWNED BY tests.id;




--
-- Name: tests_tid_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE tests_tid_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;



--
-- Name: users; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE users (
    id integer NOT NULL,
    username character varying NOT NULL,
    password character varying NOT NULL,
    group_id integer NOT NULL,
    name character varying,
    created timestamp without time zone,
    modified timestamp without time zone
);


--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE users_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('users_id_seq', 2, true);


--
-- Name: vf_testing_sites; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE vf_testing_sites (
    site_code integer NOT NULL,
    site_name character varying NOT NULL,
    type character varying NOT NULL,
    location_id integer NOT NULL,
    latitude double precision,
    longitude double precision
);


--
-- Name: vf_testing_sites_site_code_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE vf_testing_sites_site_code_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: vf_testing_sites_site_code_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE vf_testing_sites_site_code_seq OWNED BY vf_testing_sites.site_code;


--
-- Name: vf_testing_sites_site_code_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('vf_testing_sites_site_code_seq', 28, true);





--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE archive_results ALTER COLUMN id SET DEFAULT nextval('archive_results_id_seq'::regclass);





--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE educations ALTER COLUMN id SET DEFAULT nextval('educations_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE groups ALTER COLUMN id SET DEFAULT nextval('groups_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE locations ALTER COLUMN id SET DEFAULT nextval('locations_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE marital_statuses ALTER COLUMN id SET DEFAULT nextval('marital_statuses_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE occupations ALTER COLUMN id SET DEFAULT nextval('occupations_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE result_lookups ALTER COLUMN id SET DEFAULT nextval('result_lookups_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE results ALTER COLUMN id SET DEFAULT nextval('results_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE tests ALTER COLUMN id SET DEFAULT nextval('tests_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- Name: site_code; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE vf_testing_sites ALTER COLUMN site_code SET DEFAULT nextval('vf_testing_sites_site_code_seq'::regclass);



--
-- Data for Name: educations; Type: TABLE DATA; Schema: public; Owner: -
--

COPY educations (id, name, description, comment) FROM stdin;
0	None	\N	\N
1	Some primary	\N	\N
2	Some secondary	\N	\N
3	Some Post secondary	\N	\N
\.



--
-- Data for Name: locations; Type: TABLE DATA; Schema: public; Owner: -
--

COPY locations (id, name, parent_id, tree_left, tree_right, vf_code, longitude, latitude, description, comment) FROM stdin;
2	Central	1	2	3	1	\N	\N	\N	\N
3	Coast	1	4	5	2	\N	\N	\N	\N
4	Eastern	1	6	7	3	\N	\N	\N	\N
33	Shibuli	27	46	47	4	\N	\N	\N	\N
5	Nairobi Area	1	8	9	5	\N	\N	\N	\N
6	North-Eastern	1	10	11	6	\N	\N	\N	\N
7	Nyanza	1	12	13	7	\N	\N	\N	\N
8	Rift Valley	1	14	15	8	\N	\N	\N	\N
28	East Butsotso	25	53	60	3	\N	\N	\N	\N
10	Bungoma	9	17	18	1	\N	\N	\N	\N
13	Butere	9	75	76	4	\N	\N	\N	\N
14	Lugari	9	77	78	5	\N	\N	\N	\N
11	Busia	9	19	20	2	\N	\N	\N	\N
22	Shinyalu	12	30	31	5	\N	\N	\N	\N
15	Teso	9	79	80	6	\N	\N	\N	\N
16	Vihiga	9	81	82	7	\N	\N	\N	\N
38	Indangalasia	28	58	59	9	\N	\N	\N	\N
17	Mount Elgon	9	83	84	8	\N	\N	\N	\N
12	Kakamega	9	21	74	3	\N	\N	\N	\N
1	Kenya	\N	1	86	\N	\N	\N	\N	\N
9	Western	1	16	85	9	\N	\N	\N	\N
25	Lurambi	12	36	73	8	\N	\N	\N	\N
29	North Butsotso	25	61	72	4	\N	\N	\N	\N
34	Eshisuru	27	48	49	5	\N	\N	\N	\N
30	Matioli	26	38	39	1	\N	\N	\N	\N
23	Malava	12	32	33	6	\N	\N	\N	\N
43	Mathia	29	70	71	14	\N	\N	\N	\N
26	South Butsotso	25	37	42	1	\N	\N	\N	\N
24	Mumias	12	34	35	7	\N	\N	\N	\N
18	Butere	12	22	23	1	\N	\N	\N	\N
39	Esumeyia	29	62	63	10	\N	\N	\N	\N
27	Central Butsotso	25	43	52	2	\N	\N	\N	\N
35	Shiyunzu	27	50	51	6	\N	\N	\N	\N
31	Emukaya	26	40	41	2	\N	\N	\N	\N
19	Ikolomani	12	24	25	2	\N	\N	\N	\N
40	Shikomari	29	64	65	11	\N	\N	\N	\N
20	Khwisero	12	26	27	3	\N	\N	\N	\N
36	Murumba	28	54	55	7	\N	\N	\N	\N
21	Lugari	12	28	29	4	\N	\N	\N	\N
32	Shiveye	27	44	45	3	\N	\N	\N	\N
41	Shinoyi	29	66	67	12	\N	\N	\N	\N
37	Shirakalu	28	56	57	8	\N	\N	\N	\N
42	Ingotse	29	68	69	13	\N	\N	\N	\N
\.


--
-- Data for Name: marital_statuses; Type: TABLE DATA; Schema: public; Owner: -
--

COPY marital_statuses (id, name, description, comment) FROM stdin;
0	Single/Never married	\N	\N
1	Married, monogamous	\N	\N
2	Married, polygamous	\N	\N
3	Cohabiting	\N	\N
4	Divorced/Separated	\N	\N
5	Widowed	\N	\N
\.


--
-- Data for Name: occupations; Type: TABLE DATA; Schema: public; Owner: -
--

COPY occupations (id, name, description, comment) FROM stdin;
0	None	\N	\N
1	Unskilled	\N	\N
2	Skilled	\N	\N
3	Professional	\N	\N
4	Student	\N	\N
\.


--
-- Data for Name: patients; Type: TABLE DATA; Schema: public; Owner: -
--

COPY patients (pid, upn, arvid, vfcc, surname, forenames, date_of_birth, year_of_birth, sex, mother, occupation_id, education_id, marital_status_id, telephone_number, treatment_supporter, location_id, village, home, nearest_church, nearest_school, nearest_health_centre, nearest_major_landmark, vf_testing_site) FROM stdin;
\.


--
-- Data for Name: result_lookups; Type: TABLE DATA; Schema: public; Owner: -
--

COPY result_lookups (id, test_id, value, description, comment, user_id, modified) FROM stdin;
\.


--
-- Data for Name: results; Type: TABLE DATA; Schema: public; Owner: -
--

COPY results (id, pid, test_id, value_decimal, value_text, value_lookup, test_performed, created, requesting_clinician, user_id) FROM stdin;
\.


--
-- Data for Name: tests; Type: TABLE DATA; Schema: public; Owner: -
--

COPY tests (id, name, abbreiviation, type, upper_limit, lower_limit, description, comment, active, user_id, modified) FROM stdin;
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: -
--

COPY users (id, username, password, group_id, name, created, modified) FROM stdin;
1	admin	aa50ebeb6ecacbc15ef22ca164b7342db76e725bfefcc1d01086d0dcc343e247	1		2009-07-10 21:35:38	2009-07-10 21:35:38
2	user	fbcc1b48abce87fff7c6c18821157c00f80ce2707d7859daaf49efb4a2bbf218	2		2009-07-10 21:35:59	2009-07-10 21:35:59
\.


--
-- Data for Name: vf_testing_sites; Type: TABLE DATA; Schema: public; Owner: -
--

COPY vf_testing_sites (site_code, site_name, type, location_id, latitude, longitude) FROM stdin;
1	Ebukulima	Salvation Army	30	0.19305	34.613630000000001
2	Mwiyenga	Church	30	0.20582	34.634129999999999
3	Ekapwonje	Church	31	0.21640000000000001	34.614130000000003
4	Shianda	Church	31	0.23147000000000001	34.620080000000002
5	Sumba	Dispensary	32	0.24218000000000001	34.63955
6	Shirembe	Dispensary	32	0.25446999999999997	34.621119999999998
7	Ematsayi	School	32	0.27548	34.621229999999997
8	Eshikuyu	Health Centre	33	0.26477000000000001	34.655900000000003
9	Ibinzo	School	33	0.25659999999999999	34.687930000000001
10	Eshisiru	District Office	34	0.28160000000000002	34.673400000000001
11	Emusanda	Dispensary	34	0.29325000000000001	34.647599999999997
12	Ikonyero	Church	35	0.28343000000000002	34.722470000000001
13	Eshiyunzu	Church	35	0.29087000000000002	34.70355
14	Murumba	Dispensary	36	0.30314999999999998	34.726100000000002
15	Shikoti	Church	36	0.31788	34.735930000000003
16	Emukoyani	Church	37	0.32135000000000002	34.749470000000002
17	Elukho	Church	37	0.32290000000000002	34.75647
18	Emusala	Church	38	0.32965	34.780479999999997
19	Emukaba	Church	38	0.34425	34.76343
20	Bushibo	Church	39	0.30809999999999998	34.686079999999997
21	Emukaya	Health Centre	39	0.31850000000000001	34.702669999999998
22	Esumeyia	Church	39	0.31972	34.681019999999997
23	Shikomari	Church	40	0.32085000000000002	34.644480000000001
24	Gospel Spring	Church	40	0.33844999999999997	34.654780000000002
25	Shinoyi	Church	41	0.34401999999999999	34.664999999999999
26	Naluchira	Church	41	0.34894999999999998	34.694180000000003
27	Ingotse	Health Centre	42	0.35544999999999999	34.697879999999998
28	Bushiri	Church	42	0.36499999999999999	34.729170000000003
\.



--
-- Name: archive_results_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY archive_results
    ADD CONSTRAINT archive_results_pkey PRIMARY KEY (id);



--
-- Name: educations_name_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY educations
    ADD CONSTRAINT educations_name_key UNIQUE (name);


--
-- Name: educations_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY educations
    ADD CONSTRAINT educations_pkey PRIMARY KEY (id);


--
-- Name: groups_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY groups
    ADD CONSTRAINT groups_pkey PRIMARY KEY (id);


--
-- Name: locations_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY locations
    ADD CONSTRAINT locations_pkey PRIMARY KEY (id);


--
-- Name: marital_statuses_name_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY marital_statuses
    ADD CONSTRAINT marital_statuses_name_key UNIQUE (name);


--
-- Name: marital_statuses_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY marital_statuses
    ADD CONSTRAINT marital_statuses_pkey PRIMARY KEY (id);


--
-- Name: occupations_name_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY occupations
    ADD CONSTRAINT occupations_name_key UNIQUE (name);


--
-- Name: occupations_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY occupations
    ADD CONSTRAINT occupations_pkey PRIMARY KEY (id);


--
-- Name: patients_arvid_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY patients
    ADD CONSTRAINT patients_arvid_key UNIQUE (arvid);


--
-- Name: patients_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY patients
    ADD CONSTRAINT patients_pkey PRIMARY KEY (pid);


--
-- Name: patients_upn_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY patients
    ADD CONSTRAINT patients_upn_key UNIQUE (upn);


--
-- Name: patients_vfcc_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY patients
    ADD CONSTRAINT patients_vfcc_key UNIQUE (vfcc);


--
-- Name: result_lookups_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY result_lookups
    ADD CONSTRAINT result_lookups_pkey PRIMARY KEY (id);


--
-- Name: results_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY results
    ADD CONSTRAINT results_pkey PRIMARY KEY (id);


--
-- Name: tests_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tests
    ADD CONSTRAINT tests_pkey PRIMARY KEY (id);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: vf_testing_sites_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY vf_testing_sites
    ADD CONSTRAINT vf_testing_sites_pkey PRIMARY KEY (site_code);


--
-- Name: vf_testing_sites_site_name_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY vf_testing_sites
    ADD CONSTRAINT vf_testing_sites_site_name_key UNIQUE (site_name);


--
-- Name: aro_aco_key; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX aro_aco_key ON aros_acos USING btree (aro_id, aco_id);


--
-- Name: patients_education_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY patients
    ADD CONSTRAINT patients_education_id_fkey FOREIGN KEY (education_id) REFERENCES educations(id);


--
-- Name: patients_location_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY patients
    ADD CONSTRAINT patients_location_id_fkey FOREIGN KEY (location_id) REFERENCES locations(id);


--
-- Name: patients_marital_status_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY patients
    ADD CONSTRAINT patients_marital_status_id_fkey FOREIGN KEY (marital_status_id) REFERENCES marital_statuses(id);


--
-- Name: patients_occupation_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY patients
    ADD CONSTRAINT patients_occupation_id_fkey FOREIGN KEY (occupation_id) REFERENCES occupations(id);


--
-- Name: patients_vf_testing_site_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY patients
    ADD CONSTRAINT patients_vf_testing_site_fkey FOREIGN KEY (vf_testing_site) REFERENCES vf_testing_sites(site_code);


--
-- Name: vf_testing_sites_location_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY vf_testing_sites
    ADD CONSTRAINT vf_testing_sites_location_id_fkey FOREIGN KEY (location_id) REFERENCES locations(id);


--
-- PostgreSQL database dump complete
--

