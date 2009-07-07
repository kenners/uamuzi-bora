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
ALTER TABLE ONLY public.educations DROP CONSTRAINT educations_pkey;
ALTER TABLE ONLY public.educations DROP CONSTRAINT educations_name_key;
ALTER TABLE public.vf_testing_sites ALTER COLUMN site_code DROP DEFAULT;
ALTER TABLE public.tests ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.results ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.result_lookups ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.occupations ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.marital_statuses ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.locations ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.educations ALTER COLUMN id DROP DEFAULT;
DROP SEQUENCE public.vf_testing_sites_site_code_seq;
DROP TABLE public.vf_testing_sites;
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
DROP SEQUENCE public.educations_id_seq;
DROP TABLE public.educations;
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
-- Name: site_code; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE vf_testing_sites ALTER COLUMN site_code SET DEFAULT nextval('vf_testing_sites_site_code_seq'::regclass);


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

