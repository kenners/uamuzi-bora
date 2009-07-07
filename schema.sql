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
ALTER TABLE ONLY public.vf_testing_sites DROP CONSTRAINT vf_testing_sites_site_name_key;
ALTER TABLE ONLY public.vf_testing_sites DROP CONSTRAINT vf_testing_sites_pkey;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_vfcc_key;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_upn_key;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_pkey;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_arvid_key;
ALTER TABLE ONLY public.occupations DROP CONSTRAINT occupations_pkey;
ALTER TABLE ONLY public.occupations DROP CONSTRAINT occupations_name_key;
ALTER TABLE ONLY public.marital_statuses DROP CONSTRAINT marital_statuses_pkey;
ALTER TABLE ONLY public.marital_statuses DROP CONSTRAINT marital_statuses_name_key;
ALTER TABLE ONLY public.locations DROP CONSTRAINT locations_pkey;
ALTER TABLE ONLY public.educations DROP CONSTRAINT educations_pkey;
ALTER TABLE ONLY public.educations DROP CONSTRAINT educations_name_key;
ALTER TABLE public.vf_testing_sites ALTER COLUMN site_code DROP DEFAULT;
ALTER TABLE public.occupations ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.marital_statuses ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.locations ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.educations ALTER COLUMN id DROP DEFAULT;
DROP SEQUENCE public.vf_testing_sites_site_code_seq;
DROP SEQUENCE public.occupations_id_seq;
DROP SEQUENCE public.marital_statuses_id_seq;
DROP SEQUENCE public.locations_id_seq;
DROP SEQUENCE public.educations_id_seq;
DROP TABLE public.vf_testing_sites;
DROP TABLE public.patients;
DROP TABLE public.occupations;
DROP TABLE public.marital_statuses;
DROP TABLE public.locations;
DROP TABLE public.educations;
DROP SCHEMA public;
--
-- Name: public; Type: SCHEMA; Schema: -; Owner: -
--

CREATE SCHEMA public;


--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON SCHEMA public IS 'standard public schema';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

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
-- Name: marital_statuses; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE marital_statuses (
    id integer NOT NULL,
    name character varying NOT NULL,
    description character varying,
    comment character varying
);


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
-- Name: vf_testing_sites; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE vf_testing_sites (
    site_code integer NOT NULL,
    site_name character varying NOT NULL,
    type character varying NOT NULL,
    location_id integer NOT NULL,
    latitude double precision NOT NULL,
    longitude double precision NOT NULL
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
-- Name: vf_testing_sites_site_code_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE vf_testing_sites_site_code_seq
    START WITH 1
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

SELECT pg_catalog.setval('vf_testing_sites_site_code_seq', 1, false);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE educations ALTER COLUMN id SET DEFAULT nextval('educations_id_seq'::regclass);


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
-- Data for Name: vf_testing_sites; Type: TABLE DATA; Schema: public; Owner: -
--

COPY vf_testing_sites (site_code, site_name, type, location_id, latitude, longitude) FROM stdin;
\.


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

