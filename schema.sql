--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

ALTER TABLE ONLY public.vf_testing_sites DROP CONSTRAINT vf_testing_sites_location_id_fkey;
ALTER TABLE ONLY public.tests DROP CONSTRAINT tests_user_id_fkey;
ALTER TABLE ONLY public.result_lookups DROP CONSTRAINT result_lookups_user_id_fkey;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_vf_testing_site_fkey;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_occupation_id_fkey;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_marital_status_id_fkey;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_location_id_fkey;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_inactive_reason_id_fkey;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_education_id_fkey;
ALTER TABLE ONLY public.medical_informations DROP CONSTRAINT medical_informations_transfer_in_district_id_fkey;
ALTER TABLE ONLY public.medical_informations DROP CONSTRAINT medical_informations_pid_fkey;
ALTER TABLE ONLY public.medical_informations DROP CONSTRAINT medical_informations_patient_source_id_fkey;
ALTER TABLE ONLY public.medical_informations DROP CONSTRAINT medical_informations_hiv_positive_test_location_id_fkey;
ALTER TABLE ONLY public.medical_informations DROP CONSTRAINT medical_informations_funding_id_fkey;
ALTER TABLE ONLY public.medical_informations DROP CONSTRAINT medical_informations_art_service_type_id_fkey;
ALTER TABLE ONLY public.medical_informations DROP CONSTRAINT medical_informations_art_indication_id_fkey;
ALTER TABLE ONLY public.archive_patients DROP CONSTRAINT archive_patients_user_id_fkey;
ALTER TABLE ONLY public.archive_patients DROP CONSTRAINT archive_patients_archive_vf_testing_site_fkey;
ALTER TABLE ONLY public.archive_patients DROP CONSTRAINT archive_patients_archive_occupation_id_fkey;
ALTER TABLE ONLY public.archive_patients DROP CONSTRAINT archive_patients_archive_marital_status_id_fkey;
ALTER TABLE ONLY public.archive_patients DROP CONSTRAINT archive_patients_archive_location_id_fkey;
ALTER TABLE ONLY public.archive_patients DROP CONSTRAINT archive_patients_archive_inactive_reason_id_fkey;
ALTER TABLE ONLY public.archive_patients DROP CONSTRAINT archive_patients_archive_education_id_fkey;
ALTER TABLE ONLY public.archive_medical_informations DROP CONSTRAINT archive_medical_informations_user_id_fkey;
ALTER TABLE ONLY public.archive_medical_informations DROP CONSTRAINT archive_medical_informations_archive_transfer_in_district__fkey;
ALTER TABLE ONLY public.archive_medical_informations DROP CONSTRAINT archive_medical_informations_archive_pid_fkey;
ALTER TABLE ONLY public.archive_medical_informations DROP CONSTRAINT archive_medical_informations_archive_patient_source_id_fkey;
ALTER TABLE ONLY public.archive_medical_informations DROP CONSTRAINT archive_medical_informations_archive_hiv_positive_test_loc_fkey;
ALTER TABLE ONLY public.archive_medical_informations DROP CONSTRAINT archive_medical_informations_archive_funding_id_fkey;
ALTER TABLE ONLY public.archive_medical_informations DROP CONSTRAINT archive_medical_informations_archive_art_starting_regimen__fkey;
ALTER TABLE ONLY public.archive_medical_informations DROP CONSTRAINT archive_medical_informations_archive_art_service_type_id_fkey;
ALTER TABLE ONLY public.archive_medical_informations DROP CONSTRAINT archive_medical_informations_archive_art_indication_id_fkey;
DROP INDEX public.aro_aco_key;
ALTER TABLE ONLY public.vf_testing_sites DROP CONSTRAINT vf_testing_sites_site_name_key;
ALTER TABLE ONLY public.vf_testing_sites DROP CONSTRAINT vf_testing_sites_pkey;
ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
ALTER TABLE ONLY public.tests DROP CONSTRAINT tests_pkey;
ALTER TABLE ONLY public.results DROP CONSTRAINT results_pkey;
ALTER TABLE ONLY public.result_values DROP CONSTRAINT result_values_pkey;
ALTER TABLE ONLY public.result_lookups DROP CONSTRAINT result_lookups_pkey;
ALTER TABLE ONLY public.regimens DROP CONSTRAINT regimens_pkey;
ALTER TABLE ONLY public.regimens DROP CONSTRAINT regimens_name_key;
ALTER TABLE ONLY public.pep_reasons DROP CONSTRAINT pep_reasons_pkey;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_vfcc_key;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_upn_key;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_pkey;
ALTER TABLE ONLY public.patients DROP CONSTRAINT patients_arvid_key;
ALTER TABLE ONLY public.patient_sources DROP CONSTRAINT patient_sources_pkey;
ALTER TABLE ONLY public.patient_sources DROP CONSTRAINT patient_sources_name_key;
ALTER TABLE ONLY public.occupations DROP CONSTRAINT occupations_pkey;
ALTER TABLE ONLY public.occupations DROP CONSTRAINT occupations_name_key;
ALTER TABLE ONLY public.medical_informations DROP CONSTRAINT medical_informations_pkey;
ALTER TABLE ONLY public.marital_statuses DROP CONSTRAINT marital_statuses_pkey;
ALTER TABLE ONLY public.marital_statuses DROP CONSTRAINT marital_statuses_name_key;
ALTER TABLE ONLY public.locations DROP CONSTRAINT locations_pkey;
ALTER TABLE ONLY public.inactive_reasons DROP CONSTRAINT inactive_reasons_pkey;
ALTER TABLE ONLY public.inactive_reasons DROP CONSTRAINT inactive_reasons_name_key;
ALTER TABLE ONLY public.groups DROP CONSTRAINT groups_pkey;
ALTER TABLE ONLY public.fundings DROP CONSTRAINT fundings_pkey;
ALTER TABLE ONLY public.fundings DROP CONSTRAINT fundings_name_key;
ALTER TABLE ONLY public.educations DROP CONSTRAINT educations_pkey;
ALTER TABLE ONLY public.educations DROP CONSTRAINT educations_name_key;
ALTER TABLE ONLY public.art_substitutions DROP CONSTRAINT art_substitutions_pkey;
ALTER TABLE ONLY public.art_service_types DROP CONSTRAINT art_service_types_pkey;
ALTER TABLE ONLY public.art_service_types DROP CONSTRAINT art_service_types_name_key;
ALTER TABLE ONLY public.art_regimens DROP CONSTRAINT art_regimens_pkey;
ALTER TABLE ONLY public.art_interruptions DROP CONSTRAINT art_interruptions_pkey;
ALTER TABLE ONLY public.art_indications DROP CONSTRAINT art_indications_pkey;
ALTER TABLE ONLY public.art_indications DROP CONSTRAINT art_indications_name_key;
ALTER TABLE ONLY public.aros DROP CONSTRAINT aros_pkey;
ALTER TABLE ONLY public.aros_acos DROP CONSTRAINT aros_acos_pkey;
ALTER TABLE ONLY public.archive_users DROP CONSTRAINT archive_users_pkey;
ALTER TABLE ONLY public.archive_tests DROP CONSTRAINT archive_tests_pkey;
ALTER TABLE ONLY public.archive_results DROP CONSTRAINT archive_results_pkey;
ALTER TABLE ONLY public.archive_result_values DROP CONSTRAINT archive_result_values_pkey;
ALTER TABLE ONLY public.archive_result_lookups DROP CONSTRAINT archive_result_lookups_pkey;
ALTER TABLE ONLY public.archive_patients DROP CONSTRAINT archive_patients_pkey;
ALTER TABLE ONLY public.archive_medical_informations DROP CONSTRAINT archive_medical_informations_pkey;
ALTER TABLE ONLY public.archive_groups DROP CONSTRAINT archive_groups_pkey;
ALTER TABLE ONLY public.acos DROP CONSTRAINT acos_pkey;
ALTER TABLE public.vf_testing_sites ALTER COLUMN site_code DROP DEFAULT;
ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.tests ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.results ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.result_values ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.result_lookups ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.regimens ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.patient_sources ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.occupations ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.marital_statuses ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.locations ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.inactive_reasons ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.groups ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.fundings ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.educations ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.art_substitutions ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.art_service_types ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.art_regimens ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.art_interruptions ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.art_indications ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.aros_acos ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.aros ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.archive_users ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.archive_tests ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.archive_results ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.archive_result_values ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.archive_result_lookups ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.archive_patients ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.archive_medical_informations ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.archive_groups ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.acos ALTER COLUMN id DROP DEFAULT;
DROP SEQUENCE public.vf_testing_sites_site_code_seq;
DROP TABLE public.vf_testing_sites;
DROP SEQUENCE public.users_id_seq;
DROP TABLE public.users;
DROP SEQUENCE public.tests_tid_seq;
DROP SEQUENCE public.tests_id_seq;
DROP TABLE public.tests;
DROP TABLE public.second_line_reasons;
DROP SEQUENCE public.results_id_seq;
DROP TABLE public.results;
DROP SEQUENCE public.result_values_id_seq;
DROP TABLE public.result_values;
DROP SEQUENCE public.result_lookups_id_seq;
DROP TABLE public.result_lookups;
DROP SEQUENCE public.regimens_id_seq;
DROP TABLE public.regimens;
DROP TABLE public.pep_reasons;
DROP TABLE public.patients;
DROP SEQUENCE public.patient_sources_id_seq;
DROP TABLE public.patient_sources;
DROP SEQUENCE public.occupations_id_seq;
DROP TABLE public.occupations;
DROP TABLE public.medical_informations;
DROP SEQUENCE public.marital_statuses_id_seq;
DROP TABLE public.marital_statuses;
DROP SEQUENCE public.locations_id_seq;
DROP TABLE public.locations;
DROP SEQUENCE public.inactive_reasons_id_seq;
DROP TABLE public.inactive_reasons;
DROP SEQUENCE public.groups_id_seq;
DROP TABLE public.groups;
DROP SEQUENCE public.fundings_id_seq;
DROP TABLE public.fundings;
DROP SEQUENCE public.educations_id_seq;
DROP TABLE public.educations;
DROP SEQUENCE public.art_substitutions_id_seq;
DROP TABLE public.art_substitutions;
DROP TABLE public.art_substitution_reasons;
DROP SEQUENCE public.art_service_types_id_seq;
DROP TABLE public.art_service_types;
DROP TABLE public.art_second_line_reasons;
DROP SEQUENCE public.art_regimens_id_seq;
DROP TABLE public.art_regimens;
DROP SEQUENCE public.art_interruptions_id_seq;
DROP TABLE public.art_interruptions;
DROP TABLE public.art_interruption_reasons;
DROP SEQUENCE public.art_indications_id_seq;
DROP TABLE public.art_indications;
DROP SEQUENCE public.aros_id_seq;
DROP SEQUENCE public.aros_acos_id_seq;
DROP TABLE public.aros_acos;
DROP TABLE public.aros;
DROP SEQUENCE public.archive_users_id_seq;
DROP TABLE public.archive_users;
DROP SEQUENCE public.archive_tests_id_seq;
DROP TABLE public.archive_tests;
DROP SEQUENCE public.archive_results_id_seq;
DROP TABLE public.archive_results;
DROP SEQUENCE public.archive_result_values_id_seq;
DROP TABLE public.archive_result_values;
DROP SEQUENCE public.archive_result_lookups_id_seq;
DROP TABLE public.archive_result_lookups;
DROP SEQUENCE public.archive_patients_id_seq;
DROP TABLE public.archive_patients;
DROP SEQUENCE public.archive_medical_informations_id_seq;
DROP TABLE public.archive_medical_informations;
DROP SEQUENCE public.archive_groups_id_seq;
DROP TABLE public.archive_groups;
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
-- Name: acos; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE acos (
    id integer NOT NULL,
    parent_id integer,
    model character varying(255) DEFAULT NULL::character varying,
    foreign_key integer,
    alias character varying(255) DEFAULT NULL::character varying,
    lft integer,
    rght integer
);


--
-- Name: acos_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE acos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: acos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE acos_id_seq OWNED BY acos.id;


--
-- Name: acos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('acos_id_seq', 1, true);


--
-- Name: archive_groups; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE archive_groups (
    id integer NOT NULL,
    archive_id integer,
    user_id integer NOT NULL,
    created timestamp without time zone,
    archive_reason character varying,
    archive_name character varying,
    archive_description character varying,
    archive_created timestamp without time zone,
    archive_modified timestamp without time zone
);


--
-- Name: archive_groups_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE archive_groups_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: archive_groups_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE archive_groups_id_seq OWNED BY archive_groups.id;


--
-- Name: archive_groups_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('archive_groups_id_seq', 1, false);


--
-- Name: archive_medical_informations; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE archive_medical_informations (
    id integer NOT NULL,
    user_id integer NOT NULL,
    created timestamp without time zone DEFAULT now() NOT NULL,
    archive_reason character varying,
    archive_pid integer NOT NULL,
    archive_patient_source_id integer,
    archive_funding_id integer,
    archive_hiv_positive_date date,
    archive_hiv_positive_test_location_id integer,
    archive_hiv_positive_clinic_start_date date,
    archive_hiv_positive_who_stage integer,
    archive_art_naive boolean,
    archive_art_service_type_id integer,
    archive_art_starting_regimen_id integer,
    archive_art_start_date date,
    archive_art_eligibility_date date,
    archive_art_indication_id integer,
    archive_transfer_in_date date,
    archive_transfer_in_district_id integer,
    archive_transfer_in_facility text,
    archive_transfer_out_date date,
    archive_date_pep_start date,
    archive_pep_reason_id integer,
    archive_art_eligible_who_stage integer,
    archive_art_eligible_cd4 integer,
    archive_art_start_weight integer,
    archive_art_start_height integer,
    archive_art_start_who_stage integer,
    archive_art_second_start_date date,
    archive_art_second_line_reason_id integer,
    archive_drug_allergies character varying,
    archive_created timestamp without time zone,
    archive_modified timestamp without time zone
);


--
-- Name: archive_medical_informations_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE archive_medical_informations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: archive_medical_informations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE archive_medical_informations_id_seq OWNED BY archive_medical_informations.id;


--
-- Name: archive_medical_informations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('archive_medical_informations_id_seq', 1, true);


--
-- Name: archive_patients; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE archive_patients (
    id integer NOT NULL,
    user_id integer NOT NULL,
    created timestamp without time zone DEFAULT now() NOT NULL,
    archive_reason character varying,
    archive_pid integer NOT NULL,
    archive_upn character varying,
    archive_arvid character varying,
    archive_vfcc character varying,
    archive_surname character varying NOT NULL,
    archive_forenames character varying NOT NULL,
    archive_date_of_birth date,
    archive_year_of_birth integer,
    archive_sex character varying,
    archive_mother character varying,
    archive_occupation_id integer,
    archive_education_id integer,
    archive_marital_status_id integer,
    archive_telephone_number character varying,
    archive_treatment_supporter text,
    archive_location_id integer,
    archive_village character varying,
    archive_home character varying,
    archive_nearest_church character varying,
    archive_nearest_school character varying,
    archive_nearest_health_centre character varying,
    archive_nearest_major_landmark character varying,
    archive_vf_testing_site integer,
    archive_status boolean NOT NULL,
    archive_inactive_reason_id integer,
    archive_status_timestamp date,
    archive_treatment_supporter_name character varying,
    archive_treatment_supporter_relationship character varying,
    archive_treatment_supporter_address character varying,
    archive_treatment_supporter_telephone_number character varying,
    archive_created timestamp without time zone,
    archive_modified timestamp without time zone
);


--
-- Name: archive_patients_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE archive_patients_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: archive_patients_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE archive_patients_id_seq OWNED BY archive_patients.id;


--
-- Name: archive_patients_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('archive_patients_id_seq', 1, true);


--
-- Name: archive_result_lookups; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE archive_result_lookups (
    id integer NOT NULL,
    user_id integer NOT NULL,
    created timestamp without time zone,
    archive_reason character varying,
    archive_id integer,
    archive_test_id integer NOT NULL,
    archive_value character varying NOT NULL,
    archive_description character varying,
    archive_comment character varying,
    archive_user_id integer NOT NULL,
    archive_modified timestamp without time zone NOT NULL
);


--
-- Name: archive_result_lookups_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE archive_result_lookups_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: archive_result_lookups_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE archive_result_lookups_id_seq OWNED BY archive_result_lookups.id;


--
-- Name: archive_result_lookups_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('archive_result_lookups_id_seq', 1, true);


--
-- Name: archive_result_values; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE archive_result_values (
    id integer NOT NULL,
    user_id integer NOT NULL,
    created timestamp without time zone,
    archive_reason character varying,
    archive_id integer NOT NULL,
    archive_result_id integer NOT NULL,
    archive_value_decimal double precision,
    archive_value_text character varying,
    archive_value_lookup character varying,
    archive_user_id integer NOT NULL,
    archive_created timestamp without time zone NOT NULL,
    archive_modified timestamp without time zone NOT NULL
);


--
-- Name: archive_result_values_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE archive_result_values_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: archive_result_values_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE archive_result_values_id_seq OWNED BY archive_result_values.id;


--
-- Name: archive_result_values_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('archive_result_values_id_seq', 1, false);


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
    archive_test_performed timestamp without time zone,
    archive_created timestamp without time zone NOT NULL,
    archive_modified timestamp without time zone NOT NULL,
    archive_requesting_clinician character varying,
    archive_user_id integer NOT NULL
);


--
-- Name: archive_results_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE archive_results_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: archive_results_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE archive_results_id_seq OWNED BY archive_results.id;


--
-- Name: archive_results_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('archive_results_id_seq', 1, false);


--
-- Name: archive_tests; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE archive_tests (
    id integer NOT NULL,
    user_id integer NOT NULL,
    created timestamp without time zone,
    archive_reason character varying,
    archive_id integer,
    archive_name character varying NOT NULL,
    archive_abbreiviation character varying,
    archive_type character varying NOT NULL,
    archive_upper_limit double precision,
    archive_lower_limit double precision,
    archive_description character varying,
    archive_comment character varying,
    archive_active boolean DEFAULT true,
    archive_user_id integer NOT NULL,
    archive_modified timestamp without time zone NOT NULL
);


--
-- Name: archive_tests_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE archive_tests_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: archive_tests_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE archive_tests_id_seq OWNED BY archive_tests.id;


--
-- Name: archive_tests_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('archive_tests_id_seq', 1, true);


--
-- Name: archive_users; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE archive_users (
    id integer NOT NULL,
    archive_id integer,
    user_id integer NOT NULL,
    created timestamp without time zone,
    archive_reason character varying,
    archive_username character varying NOT NULL,
    archive_password character varying NOT NULL,
    archive_group_id integer NOT NULL,
    archive_name character varying,
    archive_created timestamp without time zone,
    archive_modified timestamp without time zone
);


--
-- Name: archive_users_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE archive_users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: archive_users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE archive_users_id_seq OWNED BY archive_users.id;


--
-- Name: archive_users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('archive_users_id_seq', 1, true);


--
-- Name: aros; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE aros (
    id integer NOT NULL,
    parent_id integer,
    model character varying(255) DEFAULT NULL::character varying,
    foreign_key integer,
    alias character varying(255) DEFAULT NULL::character varying,
    lft integer,
    rght integer
);


--
-- Name: aros_acos; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE aros_acos (
    id integer NOT NULL,
    aro_id integer NOT NULL,
    aco_id integer NOT NULL,
    _create character varying(2) DEFAULT '0'::character varying NOT NULL,
    _read character varying(2) DEFAULT '0'::character varying NOT NULL,
    _update character varying(2) DEFAULT '0'::character varying NOT NULL,
    _delete character varying(2) DEFAULT '0'::character varying NOT NULL
);


--
-- Name: aros_acos_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE aros_acos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: aros_acos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE aros_acos_id_seq OWNED BY aros_acos.id;


--
-- Name: aros_acos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('aros_acos_id_seq', 1, true);


--
-- Name: aros_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE aros_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: aros_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE aros_id_seq OWNED BY aros.id;


--
-- Name: aros_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('aros_id_seq', 10, true);


--
-- Name: art_indications; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE art_indications (
    id integer NOT NULL,
    name character varying NOT NULL,
    description character varying,
    comment character varying
);


--
-- Name: art_indications_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE art_indications_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: art_indications_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE art_indications_id_seq OWNED BY art_indications.id;


--
-- Name: art_indications_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('art_indications_id_seq', 3, true);


--
-- Name: art_interruption_reasons; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE art_interruption_reasons (
    id integer NOT NULL,
    name character varying NOT NULL,
    description character varying,
    comment character varying
);


--
-- Name: art_interruptions; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE art_interruptions (
    id integer NOT NULL,
    pid integer NOT NULL,
    interruption_date date NOT NULL,
    art_interruption_reason_id integer NOT NULL,
    restart_date date
);


--
-- Name: art_interruptions_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE art_interruptions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: art_interruptions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE art_interruptions_id_seq OWNED BY art_interruptions.id;


--
-- Name: art_interruptions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('art_interruptions_id_seq', 5, true);


--
-- Name: art_regimens; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE art_regimens (
    id integer NOT NULL,
    pid integer NOT NULL,
    regimen_id integer NOT NULL,
    art_line integer NOT NULL
);


--
-- Name: art_regimens_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE art_regimens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: art_regimens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE art_regimens_id_seq OWNED BY art_regimens.id;


--
-- Name: art_regimens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('art_regimens_id_seq', 28, true);


--
-- Name: art_second_line_reasons; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE art_second_line_reasons (
    id integer NOT NULL,
    name character varying NOT NULL,
    description character varying,
    comment character varying
);


--
-- Name: art_service_types; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE art_service_types (
    id integer NOT NULL,
    name character varying NOT NULL,
    description character varying,
    comment character varying
);


--
-- Name: art_service_types_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE art_service_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: art_service_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE art_service_types_id_seq OWNED BY art_service_types.id;


--
-- Name: art_service_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('art_service_types_id_seq', 5, true);


--
-- Name: art_substitution_reasons; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE art_substitution_reasons (
    id integer NOT NULL,
    name character varying NOT NULL,
    description character varying,
    comment character varying
);


--
-- Name: art_substitutions; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE art_substitutions (
    id integer NOT NULL,
    pid integer NOT NULL,
    regimen_id integer NOT NULL,
    art_substitution_reason_id integer NOT NULL,
    art_line integer NOT NULL,
    date date
);


--
-- Name: art_substitutions_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE art_substitutions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: art_substitutions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE art_substitutions_id_seq OWNED BY art_substitutions.id;


--
-- Name: art_substitutions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('art_substitutions_id_seq', 34, true);


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
    START WITH 1
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
-- Name: fundings; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE fundings (
    id integer NOT NULL,
    name character varying NOT NULL,
    description character varying,
    comment character varying
);


--
-- Name: fundings_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE fundings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: fundings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE fundings_id_seq OWNED BY fundings.id;


--
-- Name: fundings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('fundings_id_seq', 2, true);


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
    START WITH 1
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

SELECT pg_catalog.setval('groups_id_seq', 3, true);


--
-- Name: inactive_reasons; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE inactive_reasons (
    id integer NOT NULL,
    name character varying NOT NULL,
    description character varying,
    comment character varying
);


--
-- Name: inactive_reasons_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE inactive_reasons_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: inactive_reasons_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE inactive_reasons_id_seq OWNED BY inactive_reasons.id;


--
-- Name: inactive_reasons_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('inactive_reasons_id_seq', 7, true);


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
    START WITH 1
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
    START WITH 1
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
-- Name: medical_informations; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE medical_informations (
    pid integer NOT NULL,
    patient_source_id integer,
    funding_id integer,
    hiv_positive_date date,
    hiv_positive_test_location_id integer,
    hiv_positive_clinic_start_date date,
    hiv_positive_who_stage integer,
    art_naive boolean,
    art_service_type_id integer,
    art_first_start_date date,
    art_eligibility_date date,
    art_indication_id integer,
    transfer_in_date date,
    transfer_in_district_id integer,
    transfer_in_facility character varying,
    transfer_out_date date,
    transfer_out_event text,
    date_pep_start date,
    pep_reason_id integer,
    art_eligible_who_stage integer,
    art_eligible_cd4 integer,
    art_start_weight decimal,
    art_start_height decimal,
    art_start_who_stage integer,
    art_second_start_date date,
    art_second_line_reason_id integer,
    drug_allergies character varying,
    user_id integer,
    created timestamp without time zone,
    modified timestamp without time zone
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
-- Name: occupations_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE occupations_id_seq
    START WITH 1
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
-- Name: patient_sources; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE patient_sources (
    id integer NOT NULL,
    name character varying NOT NULL,
    description character varying,
    comment character varying
);


--
-- Name: patient_sources_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE patient_sources_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: patient_sources_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE patient_sources_id_seq OWNED BY patient_sources.id;


--
-- Name: patient_sources_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('patient_sources_id_seq', 10, true);


--
-- Name: patients; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE patients (
    pid integer NOT NULL,
    upn character varying NOT NULL,
    old_upn character varying,
    arvid character varying,
    vfcc character varying,
    surname character varying NOT NULL,
    forenames character varying NOT NULL,
    date_of_birth date,
    year_of_birth integer,
    sex character varying,
    mother character varying,
    occupation_id integer,
    education_id integer,
    marital_status_id integer,
    telephone_number character varying,
    location_id integer,
    village character varying,
    home character varying,
    nearest_church character varying,
    nearest_school character varying,
    nearest_health_centre character varying,
    nearest_major_landmark character varying,
    vf_testing_site integer,
    status boolean DEFAULT true NOT NULL,
    inactive_reason_id integer,
    status_timestamp date,
    treatment_supporter_name character varying,
    treatment_supporter_relationship character varying,
    treatment_supporter_address character varying,
    treatment_supporter_telephone_number character varying,
    user_id integer,
    created timestamp without time zone,
    modified timestamp without time zone
);


--
-- Name: pep_reasons; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE pep_reasons (
    id integer NOT NULL,
    name character varying NOT NULL,
    description character varying,
    comment character varying
);


--
-- Name: regimens; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE regimens (
    id integer NOT NULL,
    name character varying NOT NULL,
    description character varying,
    comment character varying
);


--
-- Name: regimens_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE regimens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: regimens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE regimens_id_seq OWNED BY regimens.id;


--
-- Name: regimens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('regimens_id_seq', 1, false);


--
-- Name: result_lookups; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE result_lookups (
    id integer NOT NULL,
    test_id integer NOT NULL,
    value character varying NOT NULL,
    description character varying NOT NULL,
    comment character varying,
    user_id integer NOT NULL,
    modified timestamp without time zone NOT NULL
);


--
-- Name: result_lookups_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE result_lookups_id_seq
    START WITH 1
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

SELECT pg_catalog.setval('result_lookups_id_seq', 114, true);


--
-- Name: result_values; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE result_values (
    id integer NOT NULL,
    result_id integer NOT NULL,
    value_decimal double precision,
    value_text character varying,
    value_lookup integer,
    user_id integer NOT NULL,
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone NOT NULL
);


--
-- Name: result_values_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE result_values_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: result_values_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE result_values_id_seq OWNED BY result_values.id;


--
-- Name: result_values_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('result_values_id_seq', 1, true);


--
-- Name: results; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE results (
    id integer NOT NULL,
    pid integer NOT NULL,
    test_id integer NOT NULL,
    test_performed timestamp without time zone,
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone NOT NULL,
    requesting_clinician character varying,
    user_id integer NOT NULL
);


--
-- Name: results_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE results_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: results_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE results_id_seq OWNED BY results.id;


--
-- Name: results_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('results_id_seq', 1, true);


--
-- Name: second_line_reasons; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE second_line_reasons (
    id integer NOT NULL,
    name character varying NOT NULL,
    description character varying,
    comment character varying
);


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
    modified timestamp without time zone NOT NULL,
    units character varying,
    multival boolean
);


--
-- Name: tests_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE tests_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: tests_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE tests_id_seq OWNED BY tests.id;


--
-- Name: tests_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('tests_id_seq', 30, true);


--
-- Name: tests_tid_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE tests_tid_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: tests_tid_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('tests_tid_seq', 1, false);


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
    START WITH 1
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

SELECT pg_catalog.setval('users_id_seq', 7, true);


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

SELECT pg_catalog.setval('vf_testing_sites_site_code_seq', 28, true);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE acos ALTER COLUMN id SET DEFAULT nextval('acos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE archive_groups ALTER COLUMN id SET DEFAULT nextval('archive_groups_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE archive_medical_informations ALTER COLUMN id SET DEFAULT nextval('archive_medical_informations_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE archive_patients ALTER COLUMN id SET DEFAULT nextval('archive_patients_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE archive_result_lookups ALTER COLUMN id SET DEFAULT nextval('archive_result_lookups_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE archive_result_values ALTER COLUMN id SET DEFAULT nextval('archive_result_values_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE archive_results ALTER COLUMN id SET DEFAULT nextval('archive_results_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE archive_tests ALTER COLUMN id SET DEFAULT nextval('archive_tests_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE archive_users ALTER COLUMN id SET DEFAULT nextval('archive_users_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE aros ALTER COLUMN id SET DEFAULT nextval('aros_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE aros_acos ALTER COLUMN id SET DEFAULT nextval('aros_acos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE art_indications ALTER COLUMN id SET DEFAULT nextval('art_indications_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE art_interruptions ALTER COLUMN id SET DEFAULT nextval('art_interruptions_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE art_regimens ALTER COLUMN id SET DEFAULT nextval('art_regimens_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE art_service_types ALTER COLUMN id SET DEFAULT nextval('art_service_types_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE art_substitutions ALTER COLUMN id SET DEFAULT nextval('art_substitutions_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE educations ALTER COLUMN id SET DEFAULT nextval('educations_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE fundings ALTER COLUMN id SET DEFAULT nextval('fundings_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE groups ALTER COLUMN id SET DEFAULT nextval('groups_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE inactive_reasons ALTER COLUMN id SET DEFAULT nextval('inactive_reasons_id_seq'::regclass);


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

ALTER TABLE patient_sources ALTER COLUMN id SET DEFAULT nextval('patient_sources_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE regimens ALTER COLUMN id SET DEFAULT nextval('regimens_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE result_lookups ALTER COLUMN id SET DEFAULT nextval('result_lookups_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE result_values ALTER COLUMN id SET DEFAULT nextval('result_values_id_seq'::regclass);


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
-- Data for Name: acos; Type: TABLE DATA; Schema: public; Owner: -
--

COPY acos (id, parent_id, model, foreign_key, alias, lft, rght) FROM stdin;
\.


--
-- Data for Name: archive_groups; Type: TABLE DATA; Schema: public; Owner: -
--

COPY archive_groups (id, archive_id, user_id, created, archive_reason, archive_name, archive_description, archive_created, archive_modified) FROM stdin;
\.


--
-- Data for Name: archive_medical_informations; Type: TABLE DATA; Schema: public; Owner: -
--

COPY archive_medical_informations (id, user_id, created, archive_reason, archive_pid, archive_patient_source_id, archive_funding_id, archive_hiv_positive_date, archive_hiv_positive_test_location_id, archive_hiv_positive_clinic_start_date, archive_hiv_positive_who_stage, archive_art_naive, archive_art_service_type_id, archive_art_starting_regimen_id, archive_art_start_date, archive_art_eligibility_date, archive_art_indication_id, archive_transfer_in_date, archive_transfer_in_district_id, archive_transfer_in_facility, archive_transfer_out_date, archive_date_pep_start, archive_pep_reason_id, archive_art_eligible_who_stage, archive_art_eligible_cd4, archive_art_start_weight, archive_art_start_height, archive_art_start_who_stage, archive_art_second_start_date, archive_art_second_line_reason_id, archive_drug_allergies, archive_created, archive_modified) FROM stdin;
\.

--
-- Data for Name: archive_patients; Type: TABLE DATA; Schema: public; Owner: -
--

COPY archive_patients (id, user_id, created, archive_reason, archive_pid, archive_upn, archive_arvid, archive_vfcc, archive_surname, archive_forenames, archive_date_of_birth, archive_year_of_birth, archive_sex, archive_mother, archive_occupation_id, archive_education_id, archive_marital_status_id, archive_telephone_number, archive_treatment_supporter, archive_location_id, archive_village, archive_home, archive_nearest_church, archive_nearest_school, archive_nearest_health_centre, archive_nearest_major_landmark, archive_vf_testing_site, archive_status, archive_inactive_reason_id, archive_status_timestamp, archive_treatment_supporter_name, archive_treatment_supporter_relationship, archive_treatment_supporter_address, archive_treatment_supporter_telephone_number, archive_created, archive_modified) FROM stdin;
\.


--
-- Data for Name: archive_result_lookups; Type: TABLE DATA; Schema: public; Owner: -
--

COPY archive_result_lookups (id, user_id, created, archive_reason, archive_id, archive_test_id, archive_value, archive_description, archive_comment, archive_user_id, archive_modified) FROM stdin;
\.


--
-- Data for Name: archive_result_values; Type: TABLE DATA; Schema: public; Owner: -
--

COPY archive_result_values (id, user_id, created, archive_reason, archive_id, archive_result_id, archive_value_decimal, archive_value_text, archive_value_lookup, archive_user_id, archive_created, archive_modified) FROM stdin;
\.


--
-- Data for Name: archive_results; Type: TABLE DATA; Schema: public; Owner: -
--

COPY archive_results (id, user_id, created, archive_reason, archive_id, archive_pid, archive_test_id, archive_test_performed, archive_created, archive_modified, archive_requesting_clinician, archive_user_id) FROM stdin;
\.


--
-- Data for Name: archive_tests; Type: TABLE DATA; Schema: public; Owner: -
--

COPY archive_tests (id, user_id, created, archive_reason, archive_id, archive_name, archive_abbreiviation, archive_type, archive_upper_limit, archive_lower_limit, archive_description, archive_comment, archive_active, archive_user_id, archive_modified) FROM stdin;

\.


--
-- Data for Name: archive_users; Type: TABLE DATA; Schema: public; Owner: -
--

COPY archive_users (id, archive_id, user_id, created, archive_reason, archive_username, archive_password, archive_group_id, archive_name, archive_created, archive_modified) FROM stdin;
\.


--
-- Data for Name: aros; Type: TABLE DATA; Schema: public; Owner: -
--

COPY aros (id, parent_id, model, foreign_key, alias, lft, rght) FROM stdin;
3	1	User	1	\N	2	3
10	1	User	7	\N	4	5
5	\N	Group	3	\N	13	20
1	\N	Group	1	\N	1	8
2	\N	Group	2	\N	9	12
4	2	User	2	\N	10	11
6	5	User	3	\N	14	15
7	5	User	4	\N	16	17
8	5	User	5	\N	18	19
9	1	User	6	\N	6	7
\.


--
-- Data for Name: aros_acos; Type: TABLE DATA; Schema: public; Owner: -
--

COPY aros_acos (id, aro_id, aco_id, _create, _read, _update, _delete) FROM stdin;
\.


--
-- Data for Name: art_indications; Type: TABLE DATA; Schema: public; Owner: -
--

COPY art_indications (id, name, description, comment) FROM stdin;
1	WHO Stage	\N	\N
2	TLC	\N	\N
3	CD4 Count	\N	\N
\.


--
-- Data for Name: art_interruption_reasons; Type: TABLE DATA; Schema: public; Owner: -
--

COPY art_interruption_reasons (id, name, description, comment) FROM stdin;
0	Default(1/12)	\N	\N
1	Lost to follow-up (3/12)	\N	\N
2	Stop	\N	\N
\.


--
-- Data for Name: art_interruptions; Type: TABLE DATA; Schema: public; Owner: -
--

COPY art_interruptions (id, pid, interruption_date, art_interruption_reason_id, restart_date) FROM stdin;
\.


--
-- Data for Name: art_regimens; Type: TABLE DATA; Schema: public; Owner: -
--

COPY art_regimens (id, pid, regimen_id, art_line) FROM stdin;
\.


--
-- Data for Name: art_second_line_reasons; Type: TABLE DATA; Schema: public; Owner: -
--

COPY art_second_line_reasons (id, name, description, comment) FROM stdin;
0	Clinical treatment failure	\N	\N
1	Immunological failure	\N	\N
2	Virologic failure	\N	\N
0	Default(1/12)	\N	\N
1	Lost to follow-up (3/12)	\N	\N
2	Stop	\N	\N
\.


--
-- Data for Name: art_service_types; Type: TABLE DATA; Schema: public; Owner: -
--

COPY art_service_types (id, name, description, comment) FROM stdin;
0	Not on ART	\N	\N
1	ART	\N	\N
2	PMTCT	\N	\N
3	PEP (Assualt)	\N	\N
4	PEP (Occupational)	\N	\N
5	OI Only	\N	\N
\.


--
-- Data for Name: art_substitution_reasons; Type: TABLE DATA; Schema: public; Owner: -
--

COPY art_substitution_reasons (id, name, description, comment) FROM stdin;
1	Toxicity/Side effects	\N	\N
2	Pregnancy	\N	\N
3	Risk of pregnancy	\N	\N
4	Due to new TB	\N	\N
5	New drug available	\N	\N
6	Drug out of stock	\N	\N
7	Other	\N	\N
\.


--
-- Data for Name: art_substitutions; Type: TABLE DATA; Schema: public; Owner: -
--

COPY art_substitutions (id, pid, regimen_id, art_substitution_reason_id, art_line, date) FROM stdin;
\.


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
-- Data for Name: fundings; Type: TABLE DATA; Schema: public; Owner: -
--

COPY fundings (id, name, description, comment) FROM stdin;
1	GOK/NASCOP	\N	\N
2	USA/PEPFAR	\N	\N
\.


--
-- Data for Name: groups; Type: TABLE DATA; Schema: public; Owner: -
--

COPY groups (id, name, description, created, modified) FROM stdin;
1	admin		2009-07-10 21:35:23	2009-07-10 21:35:23
2	user		2009-07-10 21:35:27	2009-07-10 21:35:27
3	data	Group for mass data entry	2010-04-11 21:37:20	2010-04-11 21:37:20
\.


--
-- Data for Name: inactive_reasons; Type: TABLE DATA; Schema: public; Owner: -
--

COPY inactive_reasons (id, name, description, comment) FROM stdin;
0	None	\N	\N
1	Default (1 month)	\N	\N
2	Lost to Follow Up (3 months)	\N	\N
3	Stop	\N	\N
4	Deceased	\N	\N
5	PEP End	\N	\N
6	PMTCT End	\N	\N
7	Lost to Follow-up	\N	\N
8	Transfer Out	\N	\N
9	Stopped by Physician	\N	\N
10	Stopped as Duplicate Record	\N	\N
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
-- Data for Name: medical_informations; Type: TABLE DATA; Schema: public; Owner: -
--

COPY medical_informations (pid, patient_source_id, funding_id, hiv_positive_date, hiv_positive_test_location_id, hiv_positive_clinic_start_date, hiv_positive_who_stage, art_naive, art_service_type_id, art_first_start_date, art_eligibility_date, art_indication_id, transfer_in_date, transfer_in_district_id, transfer_in_facility, transfer_out_date, transfer_out_event, date_pep_start, pep_reason_id, art_eligible_who_stage, art_eligible_cd4, art_start_weight, art_start_height, art_start_who_stage, art_second_start_date, art_second_line_reason_id, drug_allergies, user_id, created, modified) FROM stdin;
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
-- Data for Name: patient_sources; Type: TABLE DATA; Schema: public; Owner: -
--

COPY patient_sources (id, name, description, comment) FROM stdin;
1	PMTCT	\N	\N
2	Inpatient	\N	\N
3	VCT	\N	\N
4	Child Welfare Clinic	\N	\N
5	TB OPD	\N	\N
6	VF	\N	\N
7	OPD 	\N	\N
8	PITC	\N	\N
9	Other	\N	\N
\.


--
-- Data for Name: patients; Type: TABLE DATA; Schema: public; Owner: -
--

COPY patients (pid, upn, old_upn, arvid, vfcc, surname, forenames, date_of_birth, year_of_birth, sex, mother, occupation_id, education_id, marital_status_id, telephone_number, location_id, village, home, nearest_church, nearest_school, nearest_health_centre, nearest_major_landmark, vf_testing_site, status, inactive_reason_id, status_timestamp, treatment_supporter_name, treatment_supporter_relationship, treatment_supporter_address, treatment_supporter_telephone_number, user_id, created, modified) FROM stdin;
\.


--
-- Data for Name: pep_reasons; Type: TABLE DATA; Schema: public; Owner: -
--

COPY pep_reasons (id, name, description, comment) FROM stdin;
1	Sexual assault	\N	\N
2	Occupational exposure	\N	\N
3	Others	\N	\N
\.


--
-- Data for Name: regimens; Type: TABLE DATA; Schema: public; Owner: -
--

COPY regimens (id, name, description, comment) FROM stdin;
1	1A (D4T30/3TC/NVP)	1st Line	\N
2	2A (D4T30/3TC/EFV)	1st Line	\N
3	3A (AZT/3TC/EFV)	1st Line	\N
4	3B (AZT/3TC/NVP)	1st Line	\N
5	R66 (TDF/3FC/NVP)	2nd Line	\N
6	R67 (ABC/DDI/LPVR)	2nd Line	\N
7	PEP1 (AZT/3TC)	PEP	\N
8	Other	Other	\N
\.


--
-- Data for Name: result_lookups; Type: TABLE DATA; Schema: public; Owner: -
--

COPY result_lookups (id, test_id, value, description, comment, user_id, modified) FROM stdin;
1	1	A	Arrived		1	2009-07-19 22:38:09
2	1	S	Seen		1	2009-07-19 22:38:59
3	1	DNA	Did Not Attend		1	2009-07-19 22:38:59
4	6	1	Stage 1		1	2009-07-19 22:38:59
5	6	2	Stage 2		1	2009-07-19 22:38:59
6	6	3	Stage 3		1	2009-07-19 22:38:59
7	6	4	Stage 4		1	2009-07-19 22:38:59
8	7	N	No		1	2009-07-19 22:41:43
9	7	Y	Yes		1	2009-07-19 22:42:04
10	9	Y	Yes		1	2009-07-19 22:44:48
11	9	N	No		1	2009-07-19 22:44:58
12	10	1	No Signs		1	2009-07-19 22:46:21
13	10	2	TB Suspected		1	2009-07-19 22:46:31
14	10	3	Receiving TB Treatment		1	2009-07-19 22:46:45
15	11	1	Herpes Zoster		1	2009-07-19 22:48:32
16	11	2	Pneumonia		1	2009-07-19 22:48:41
17	11	3	Dementia / Encephalitis		1	2009-07-19 22:48:55
18	11	4	Thrush		1	2009-07-19 22:49:36
19	11	5	Ulcers		1	2009-07-19 22:51:10
20	11	6	Fever		1	2009-07-19 22:51:20
21	11	7	Cough		1	2009-07-19 22:51:28
22	11	8	Difficulty Breathing		1	2009-07-19 22:51:39
23	11	9	IRIS		1	2009-07-19 22:52:00
24	11	10	Weight Loss		1	2009-07-19 22:52:10
25	11	11	Urethral Discharge		1	2009-07-19 22:52:19
26	11	12	Pelvic Inflammatory Disease		1	2009-07-19 22:52:32
27	11	13	Genital Ulcerative Disease		1	2009-07-19 22:52:48
28	14	1	Peripheral Neuropathy		1	2009-07-19 22:53:46
29	14	2	Rash		1	2009-07-19 22:53:53
30	14	3	Anaemia		1	2009-07-19 22:54:00
31	14	4	Pancreatitis		1	2009-07-19 22:54:09
32	14	5	Jaundice		1	2009-07-19 22:54:19
33	14	6	Fat Redistribution		1	2009-07-19 22:54:31
34	14	7	Hypersensitivity		1	2009-07-19 22:54:41
35	14	8	Hepatotoxicity		1	2009-07-19 22:54:51
36	14	9	CNS Symptoms		1	2009-07-19 22:55:10
37	15	Y	Yes		1	2009-07-19 22:56:30
38	15	YS	Yes (SA)		1	2009-07-19 22:56:30
39	15	YU	Yes (UA)		1	2009-07-19 22:56:46
40	15	N	No		1	2009-07-19 22:56:54
41	16	Y	Yes		1	2009-07-19 22:56:30
42	16	YS	Yes (SA)		1	2009-07-19 22:57:34
43	16	YU	Yes (UA)		1	2009-07-19 22:57:46
44	16	N	No		1	2009-07-19 22:58:04
45	20	1A	1A (D4T30/3TC/NVP)	1st Line	1	2009-07-19 22:38:09
46	20	2A	2A (D4T30/3TC/EFV)	1st Line	1	2009-07-19 22:38:09
47	20	3A	3A (AZT/3TC/EFV)	1st Line	1	2009-07-19 22:38:09
48	20	3B	3B (AZT/3TC/NVP)	1st Line	1	2009-07-19 22:38:09
49	20	R66	R66 (TDF/3FC/NVP)	2nd Line	1	2009-07-19 22:38:09
50	20	R67	R67 (ABC/DDI/LPVR)	2nd Line	1	2009-07-19 22:38:09
51	20	PEP1	PEP1 (AZT/3TC)	PEP	1	2009-07-19 22:38:09
52	20	O	Other	Other	1	2009-07-19 22:38:09
53	20	U	Unknown	Unknown	1	2009-07-19 22:38:09
54	19	Y	Yes		1	2009-07-19 22:56:30
55	19	YS	Yes (SA)		1	2009-07-19 23:00:35
56	19	YU	Yes (UA)		1	2009-07-19 23:00:44
57	19	N	No		1	2009-07-19 23:00:52
58	25	1	Basic HIV Education, transmission		1	2009-07-19 23:04:20
59	25	2	Prevention: abstinenece, safer sex, condoms		1	2009-07-19 23:04:20
60	25	3	Prevention: household precautions, what is safe		1	2009-07-19 23:04:20
61	25	4	Post-test counselling: implications of results		1	2009-07-19 23:04:20
62	25	5	Positive living		1	2009-07-19 23:04:20
63	25	6	Testing partners-Discordants		1	2009-07-19 23:04:20
64	25	7	Disclosure		1	2009-07-19 23:04:20
65	25	8	To whom disclosed		1	2009-07-19 23:04:20
66	25	9	Family/living situation		1	2009-07-19 23:04:20
67	25	10	Shared confidentiality		1	2009-07-19 23:04:20
68	25	11	Reproductive choices, prevention MTCT		1	2009-07-19 23:04:20
69	25	12	Progression of disease		1	2009-07-19 23:04:20
70	25	13	Available treatment/prophylaxis		1	2009-07-19 23:04:20
71	25	14	Follow-up appointments, clinical team		1	2009-07-19 23:04:20
72	25	15	CTX, prophylaxis		1	2009-07-19 23:04:20
73	25	16	ART - educate on essentials (locally adapted)		1	2009-07-19 23:04:20
74	25	17	Why complete adherence needed		1	2009-07-19 23:04:20
75	25	18	Adherence preparation		1	2009-07-19 23:04:20
76	25	19	Indicate when READY for ART		1	2009-07-19 23:04:20
77	25	20	Explain dose, when to take		1	2009-07-19 23:04:20
78	25	21	What can occur, how to manage SEs		1	2009-07-19 23:04:20
79	25	22	What to do if one forgets dose		1	2009-07-19 23:04:20
80	25	23	What to do when travelling		1	2009-07-19 23:04:20
81	25	24	Adherence plan (schedule, aids, explain diary)		1	2009-07-19 23:04:20
82	25	25	Treatment supporter preparation		1	2009-07-19 23:04:20
83	25	26	Which doses, why missed		1	2009-07-19 23:04:20
84	25	27	ARV support group		1	2009-07-19 23:04:20
85	25	28	How to contact clinic		1	2009-07-19 23:04:20
86	25	29	Symptom management/palliative care at home		1	2009-07-19 23:04:20
87	25	30	Caregiver booklet		1	2009-07-19 23:04:20
88	25	31	Home-based care		1	2009-07-19 23:04:20
89	25	32	Support groups		1	2009-07-19 23:04:20
90	25	33	Community support		1	2009-07-19 23:04:20
91	17	1	Amoxicillin		1	2010-04-13 20:26:53
93	17	2	Ciprofloxacin		1	2010-04-13 20:28:05
94	17	3	Cotrimoxazole		1	2010-04-13 20:28:23
100	12	2	Diarrhoea (watery)		1	2010-04-13 20:34:39
92	17	4	Doxycycline		1	2010-04-13 20:27:50
95	17	5	Flagyl		1	2010-04-13 20:29:57
101	12	3	Helminthiasis		1	2010-04-13 20:34:51
96	17	7	Piriton		1	2010-04-13 20:30:19
98	17	6	Multivitamins		1	2010-04-13 20:30:58
99	12	1	Diarrhoea (bloody)		1	2010-04-13 20:34:21
102	12	4	Malaria		1	2010-04-13 20:35:00
104	12	6	RTI (upper)		1	2010-04-13 20:35:30
103	12	5	Pneumonia (lower RTI)		1	2010-04-13 20:35:19
105	12	7	Other (please specify)		1	2010-04-13 20:37:10
106	17	8	Paracetamol		7	2010-04-14 07:50:41
107	17	9	Ibuprofen		7	2010-04-14 07:50:56
108	17	10	Metronidazole		6	2010-04-14 07:56:51
109	17	11	Acyclovir		6	2010-04-14 07:59:09
110	17	12	Fluconazole		6	2010-04-14 07:59:21
111	17	13	Ketonazole		6	2010-04-14 07:59:50
112	17	14	Erythromycin		1	2010-04-14 10:24:33
113	17	15	Cefuroxime		1	2010-04-14 10:24:51
97	17	17	Other (please specify)		1	2010-04-13 20:30:39
114	17	16	Nystatin		1	2010-04-14 10:25:12
\.


--
-- Data for Name: result_values; Type: TABLE DATA; Schema: public; Owner: -
--

COPY result_values (id, result_id, value_decimal, value_text, value_lookup, user_id, created, modified) FROM stdin;
\.


--
-- Data for Name: results; Type: TABLE DATA; Schema: public; Owner: -
--

COPY results (id, pid, test_id, test_performed, created, modified, requesting_clinician, user_id) FROM stdin;
\.


--
-- Data for Name: second_line_reasons; Type: TABLE DATA; Schema: public; Owner: -
--

COPY second_line_reasons (id, name, description, comment) FROM stdin;
\.


--
-- Data for Name: tests; Type: TABLE DATA; Schema: public; Owner: -
--

COPY tests (id, name, abbreiviation, type, upper_limit, lower_limit, description, comment, active, user_id, modified, units, multival) FROM stdin;
1	Clinic Attendance	Attendance	lookup	\N	\N	A record of a patient's clinic attendance		t	1	2009-07-19 22:37:59		\N
2	Weight	Wt	decimal	\N	\N	The patient's current weight in kilograms.		t	1	2009-07-19 22:39:59	kg	\N
3	Height	Ht	decimal	\N	\N	The patient's current height in metres.		t	1	2009-07-19 22:40:22	m	\N
4	Temperature	Temp	decimal	\N	\N	The patient's temperature in degrees Celsius.		t	1	2009-07-19 22:41:10	ºC	\N
5	Blood Pressure	BP	text	\N	\N	The patient's blood pressure (systolic/diastolic)		t	1	2009-07-19 22:41:10		\N
6	WHO Stage		lookup	\N	\N	The patient's current WHO Stage (1-4)		t	1	2009-07-19 22:41:10		\N
7	Pregnant		lookup	\N	\N	Is the patient currently pregnant?		t	1	2009-07-19 22:41:32		\N
8	Last Menstrual Period	LMP	text	\N	\N	Date of the patient's last menstrual period in the format DD-MM-YYYY		t	1	2009-07-19 22:43:46		\N
10	TB Status		lookup	\N	\N	The current TB status of the patient.		t	1	2009-07-19 22:46:10		\N
15	Cotrimoxazole Status		lookup	\N	\N	Is the patient taking cotrimoxazole?		t	1	2009-07-19 22:56:15		\N
16	Fluconazole Status		lookup	\N	\N	Is the patient taking fluconazole?		t	1	2009-07-19 22:57:27		\N
19	ARV Drug Adherence		lookup	\N	\N			t	1	2009-07-19 23:00:28		\N
20	ARV Drug Regimen		lookup	\N	\N			t	1	2009-07-19 22:59:43		\N
21	CD4 Count	CD4	decimal	\N	\N	The patient's current CD4 count.		t	1	2009-07-19 23:01:45	/μl	\N
22	Haemaglobin	Hb	decimal	\N	\N	The patient's current haemaglobin level.		t	1	2009-07-19 23:02:16	g/dL	\N
23	White Cell Count	WCC	decimal	\N	\N	The patient's current white cell count.		t	1	2009-07-19 23:03:10	x10^9	\N
24	ALT	ALT	decimal	\N	\N			t	1	2009-07-19 23:03:50	IU	\N
27	Counselling		lookup	\N	\N	Has the patient received any form of counselling?		t	1	2009-07-19 23:04:24		\N
29	Examination Findings		text	\N	\N			t	1	2009-07-19 23:05:58		\N
9	Family Planning Status	FP Status	lookup	\N	\N	Is the patient using any form of contraception?		t	1	2009-07-19 22:44:36		f
11	Opportunistic Infection	Opportunistic Infection	lookup	\N	\N	Does the patient have a new opportunistic infection?		t	1	2009-07-19 22:48:23		t
14	ART Side Effects	ART Side Effects	lookup	\N	\N	Is the patient currently experiencing any side-effects of ARTs?		t	1	2009-07-19 22:53:32		t
17	Other Medications Dispensed	Other Medications	lookup	\N	\N	Have any other medications been dispensed to the patient?		t	1	2009-07-19 22:58:40		t
12	Other Medical Conditions		lookup	\N	\N	Does the patient have any new other medical condition?		t	1	2009-07-19 22:48:23		t
13	Conditions (others)		text	\N	\N	\N		t	1	2009-07-19 22:48:23		\N
18	Medications (others)		text	\N	\N	\N		t	1	2009-07-19 22:48:23		\N
25	Adherence counselling		lookup	\N	\N			t	7	2009-07-19 23:04:13		t
26	Refered To		text	\N	\N			t	1	2009-07-19 23:05:12		f
28	Date Of Next Appointment		text	\N	\N	The date of the patient's next appointment in the format DD-MM-YYYY		t	1	2009-07-19 23:05:44		f
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: -
--

COPY users (id, username, password, group_id, name, created, modified) FROM stdin;
1	admin	82bf611c53901f13c54e59f032a4d4714168c505075f7010d05ff2d8062a8c9e	1		2009-07-10 21:35:38	2009-07-10 21:35:38
2	user	89ef4f9d082dad635f13d9aab392a2ce41f47dbfd28d783e023ccfd5213a1a67	2		2009-07-10 21:35:59	2009-07-10 21:35:59
3	data	78732071c8fa23f1587f71b1bd7169b3e186c978e2cc1cf281580b9a9cad31d7	3	\N	2010-04-11 23:29:55	2010-04-11 23:29:55
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
29	Emulama	Church	43	0.37630000000000002	34.755450000000003
30	Matiha	Church	43	0.36153000000000002	34.76567
31	Shikakala	Unknown	25	\N	\N
\.


--
-- Name: acos_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY acos
    ADD CONSTRAINT acos_pkey PRIMARY KEY (id);


--
-- Name: archive_groups_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY archive_groups
    ADD CONSTRAINT archive_groups_pkey PRIMARY KEY (id);


--
-- Name: archive_medical_informations_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY archive_medical_informations
    ADD CONSTRAINT archive_medical_informations_pkey PRIMARY KEY (id);


--
-- Name: archive_patients_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY archive_patients
    ADD CONSTRAINT archive_patients_pkey PRIMARY KEY (id);


--
-- Name: archive_result_lookups_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY archive_result_lookups
    ADD CONSTRAINT archive_result_lookups_pkey PRIMARY KEY (id);


--
-- Name: archive_result_values_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY archive_result_values
    ADD CONSTRAINT archive_result_values_pkey PRIMARY KEY (id);


--
-- Name: archive_results_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY archive_results
    ADD CONSTRAINT archive_results_pkey PRIMARY KEY (id);


--
-- Name: archive_tests_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY archive_tests
    ADD CONSTRAINT archive_tests_pkey PRIMARY KEY (id);


--
-- Name: archive_users_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY archive_users
    ADD CONSTRAINT archive_users_pkey PRIMARY KEY (id);


--
-- Name: aros_acos_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY aros_acos
    ADD CONSTRAINT aros_acos_pkey PRIMARY KEY (id);


--
-- Name: aros_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY aros
    ADD CONSTRAINT aros_pkey PRIMARY KEY (id);


--
-- Name: art_indications_name_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY art_indications
    ADD CONSTRAINT art_indications_name_key UNIQUE (name);


--
-- Name: art_indications_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY art_indications
    ADD CONSTRAINT art_indications_pkey PRIMARY KEY (id);


--
-- Name: art_interruptions_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY art_interruptions
    ADD CONSTRAINT art_interruptions_pkey PRIMARY KEY (id);


--
-- Name: art_regimens_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY art_regimens
    ADD CONSTRAINT art_regimens_pkey PRIMARY KEY (id);


--
-- Name: art_service_types_name_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY art_service_types
    ADD CONSTRAINT art_service_types_name_key UNIQUE (name);


--
-- Name: art_service_types_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY art_service_types
    ADD CONSTRAINT art_service_types_pkey PRIMARY KEY (id);


--
-- Name: art_substitutions_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY art_substitutions
    ADD CONSTRAINT art_substitutions_pkey PRIMARY KEY (id);


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
-- Name: fundings_name_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY fundings
    ADD CONSTRAINT fundings_name_key UNIQUE (name);


--
-- Name: fundings_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY fundings
    ADD CONSTRAINT fundings_pkey PRIMARY KEY (id);


--
-- Name: groups_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY groups
    ADD CONSTRAINT groups_pkey PRIMARY KEY (id);


--
-- Name: inactive_reasons_name_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY inactive_reasons
    ADD CONSTRAINT inactive_reasons_name_key UNIQUE (name);


--
-- Name: inactive_reasons_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY inactive_reasons
    ADD CONSTRAINT inactive_reasons_pkey PRIMARY KEY (id);


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
-- Name: medical_informations_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY medical_informations
    ADD CONSTRAINT medical_informations_pkey PRIMARY KEY (pid);


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
-- Name: patient_sources_name_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY patient_sources
    ADD CONSTRAINT patient_sources_name_key UNIQUE (name);


--
-- Name: patient_sources_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY patient_sources
    ADD CONSTRAINT patient_sources_pkey PRIMARY KEY (id);


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
-- Name: pep_reasons_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY pep_reasons
    ADD CONSTRAINT pep_reasons_pkey PRIMARY KEY (id);


--
-- Name: regimens_name_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY regimens
    ADD CONSTRAINT regimens_name_key UNIQUE (name);


--
-- Name: regimens_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY regimens
    ADD CONSTRAINT regimens_pkey PRIMARY KEY (id);


--
-- Name: result_lookups_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY result_lookups
    ADD CONSTRAINT result_lookups_pkey PRIMARY KEY (id);


--
-- Name: result_values_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY result_values
    ADD CONSTRAINT result_values_pkey PRIMARY KEY (id);


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
-- Name: archive_medical_informations_archive_art_indication_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY archive_medical_informations
    ADD CONSTRAINT archive_medical_informations_archive_art_indication_id_fkey FOREIGN KEY (archive_art_indication_id) REFERENCES art_indications(id);


--
-- Name: archive_medical_informations_archive_art_service_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY archive_medical_informations
    ADD CONSTRAINT archive_medical_informations_archive_art_service_type_id_fkey FOREIGN KEY (archive_art_service_type_id) REFERENCES art_service_types(id);


--
-- Name: archive_medical_informations_archive_art_starting_regimen__fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY archive_medical_informations
    ADD CONSTRAINT archive_medical_informations_archive_art_starting_regimen__fkey FOREIGN KEY (archive_art_starting_regimen_id) REFERENCES regimens(id);


--
-- Name: archive_medical_informations_archive_funding_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY archive_medical_informations
    ADD CONSTRAINT archive_medical_informations_archive_funding_id_fkey FOREIGN KEY (archive_funding_id) REFERENCES fundings(id);


--
-- Name: archive_medical_informations_archive_hiv_positive_test_loc_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY archive_medical_informations
    ADD CONSTRAINT archive_medical_informations_archive_hiv_positive_test_loc_fkey FOREIGN KEY (archive_hiv_positive_test_location_id) REFERENCES locations(id);


--
-- Name: archive_medical_informations_archive_patient_source_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY archive_medical_informations
    ADD CONSTRAINT archive_medical_informations_archive_patient_source_id_fkey FOREIGN KEY (archive_patient_source_id) REFERENCES patient_sources(id);


--
-- Name: archive_medical_informations_archive_pid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY archive_medical_informations
    ADD CONSTRAINT archive_medical_informations_archive_pid_fkey FOREIGN KEY (archive_pid) REFERENCES patients(pid);


--
-- Name: archive_medical_informations_archive_transfer_in_district__fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY archive_medical_informations
    ADD CONSTRAINT archive_medical_informations_archive_transfer_in_district__fkey FOREIGN KEY (archive_transfer_in_district_id) REFERENCES locations(id);


--
-- Name: archive_medical_informations_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY archive_medical_informations
    ADD CONSTRAINT archive_medical_informations_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id);


--
-- Name: archive_patients_archive_education_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY archive_patients
    ADD CONSTRAINT archive_patients_archive_education_id_fkey FOREIGN KEY (archive_education_id) REFERENCES educations(id);


--
-- Name: archive_patients_archive_inactive_reason_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY archive_patients
    ADD CONSTRAINT archive_patients_archive_inactive_reason_id_fkey FOREIGN KEY (archive_inactive_reason_id) REFERENCES inactive_reasons(id);


--
-- Name: archive_patients_archive_location_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY archive_patients
    ADD CONSTRAINT archive_patients_archive_location_id_fkey FOREIGN KEY (archive_location_id) REFERENCES locations(id);


--
-- Name: archive_patients_archive_marital_status_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY archive_patients
    ADD CONSTRAINT archive_patients_archive_marital_status_id_fkey FOREIGN KEY (archive_marital_status_id) REFERENCES marital_statuses(id);


--
-- Name: archive_patients_archive_occupation_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY archive_patients
    ADD CONSTRAINT archive_patients_archive_occupation_id_fkey FOREIGN KEY (archive_occupation_id) REFERENCES occupations(id);


--
-- Name: archive_patients_archive_vf_testing_site_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY archive_patients
    ADD CONSTRAINT archive_patients_archive_vf_testing_site_fkey FOREIGN KEY (archive_vf_testing_site) REFERENCES vf_testing_sites(site_code);


--
-- Name: archive_patients_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY archive_patients
    ADD CONSTRAINT archive_patients_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id);


--
-- Name: medical_informations_art_indication_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY medical_informations
    ADD CONSTRAINT medical_informations_art_indication_id_fkey FOREIGN KEY (art_indication_id) REFERENCES art_indications(id);


--
-- Name: medical_informations_art_service_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY medical_informations
    ADD CONSTRAINT medical_informations_art_service_type_id_fkey FOREIGN KEY (art_service_type_id) REFERENCES art_service_types(id);


--
-- Name: medical_informations_funding_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY medical_informations
    ADD CONSTRAINT medical_informations_funding_id_fkey FOREIGN KEY (funding_id) REFERENCES fundings(id);


--
-- Name: medical_informations_hiv_positive_test_location_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY medical_informations
    ADD CONSTRAINT medical_informations_hiv_positive_test_location_id_fkey FOREIGN KEY (hiv_positive_test_location_id) REFERENCES locations(id);


--
-- Name: medical_informations_patient_source_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY medical_informations
    ADD CONSTRAINT medical_informations_patient_source_id_fkey FOREIGN KEY (patient_source_id) REFERENCES patient_sources(id);


--
-- Name: medical_informations_pid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY medical_informations
    ADD CONSTRAINT medical_informations_pid_fkey FOREIGN KEY (pid) REFERENCES patients(pid);


--
-- Name: medical_informations_transfer_in_district_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY medical_informations
    ADD CONSTRAINT medical_informations_transfer_in_district_id_fkey FOREIGN KEY (transfer_in_district_id) REFERENCES locations(id);


--
-- Name: patients_education_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY patients
    ADD CONSTRAINT patients_education_id_fkey FOREIGN KEY (education_id) REFERENCES educations(id);


--
-- Name: patients_inactive_reason_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY patients
    ADD CONSTRAINT patients_inactive_reason_id_fkey FOREIGN KEY (inactive_reason_id) REFERENCES inactive_reasons(id);


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
-- Name: result_lookups_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY result_lookups
    ADD CONSTRAINT result_lookups_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id);


--
-- Name: tests_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY tests
    ADD CONSTRAINT tests_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id);


--
-- Name: vf_testing_sites_location_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY vf_testing_sites
    ADD CONSTRAINT vf_testing_sites_location_id_fkey FOREIGN KEY (location_id) REFERENCES locations(id);


--
-- PostgreSQL database dump complete
--

