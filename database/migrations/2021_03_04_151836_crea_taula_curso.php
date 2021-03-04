<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreaTaulaCurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('terms', function (Blueprint $table) {
            $table->id();
            $table->timestamp("start");
            $table->timestamp("end");
            $table->string("name");
            $table->longText("description");
            $table->boolean("active");
        });
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("term_id")->usigned();
            $table->string("name");
            $table->string("code");
            $table->longText("description");

            $table->foreign("term_id")->references("id")->on("terms");
            
        });

        Schema::create('mps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("career_id")->usigned();
            $table->string("name");
            $table->string("code");
            $table->longText("description");

            $table->foreign("career_id")->references("id")->on("careers");

        });

        Schema::create('ufs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("mp_id")->usigned();
            $table->string("name");
            $table->string("code");
            $table->longText("description");

            $table->foreign("mp_id")->references("id")->on("mps");

        });

        Schema::create('enrolments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->usigned();
            $table->unsignedBigInteger("term_id")->usigned();
            $table->unsignedBigInteger("career_id")->usigned();
            $table->string("dni");
            $table->enum('enrolemntStatus',['active','inactive']);

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("term_id")->references("id")->on("terms");
            $table->foreign("career_id")->references("id")->on("careers");

        });

        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->usigned();
            $table->unsignedBigInteger("uf_id")->usigned();

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("uf_id")->references("id")->on("ufs");

            

        });

        Schema::create('profile_reqs', function (Blueprint $table) {
            $table->id();
            $table->string("name");
        });

        Schema::create('requirements', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->unsignedBigInteger("profile_id")->usigned();

            $table->foreign("profile_id")->references("id")->on("profile_reqs");

        });
        Schema::create('req_enrols', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("req_id")->usigned();
            $table->unsignedBigInteger("enrolment_id")->usigned();
            $table->enum("state",['active','inactive']);
            
            $table->foreign("req_id")->references("id")->on("requirements");
            $table->foreign("enrolment_id")->references("id")->on("enrolments");

        });
        
        Schema::create('enrolment_ufs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("enrolment_id")->usigned();

            $table->foreign("enrolment_id")->references("id")->on("enrolments");            

        });

        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->binary("data");
            $table->unsignedBigInteger("req_enrol_id");

            $table->foreign("req_enrol_id")->references("id")->on("req_enrols");            

        });
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("level");
            $table->timestamp("time");
            $table->string("message");

            $table->foreign("user_id")->references("id")->on("users");            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('terms');

        Schema::table("careers", function(Blueprint $table){
            $table->dropColumn('term_id');
        });
        Schema::dropIfExists('careers');

        Schema::table("mps", function(Blueprint $table){
            $table->dropColumn('career_id');
        });
        Schema::dropIfExists('mps');

        Schema::table("ufs", function(Blueprint $table){
            $table->dropColumn('mps_id');
        });
        Schema::dropIfExists('ufs');

        Schema::table("enrolments", function(Blueprint $table){
            $table->dropColumn('user_id');
            $table->dropColumn('term_id');
            $table->dropColumn('career_id');
        });
        Schema::dropIfExists('enrolments');

        Schema::table("records", function(Blueprint $table){
            $table->dropColumn('user_id');
            $table->dropColumn('uf_id');
        });
        Schema::dropIfExists('records');

        Schema::table("requirements", function(Blueprint $table){
            $table->dropColumn('profile_id');
        });
        Schema::dropIfExists('requirements');

        Schema::dropIfExists('profire_req');


        Schema::table("req_enrol", function(Blueprint $table){
            $table->dropColumn('req_id');
            $table->dropColumn('enrolment_id');

        });
        Schema::dropIfExists('req_enrol');
        
        Schema::table("enrolemnt_ufs", function(Blueprint $table){
            $table->dropColumn('enrolment_id');
           

        });
        Schema::dropIfExists('enrolment_ufs');

        Schema::table("uploads", function(Blueprint $table){
            $table->dropColumn('req_enrol_id');
           

        });
        Schema::dropIfExists('uploads');
        Schema::table("logs", function(Blueprint $table){
            $table->dropColumn('user_id');
           

        });
        Schema::dropIfExists('logs');
    }
}
