<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('user');
                // pour cette évaluation, je veux créer un site 'privé' dans son fonctionnement.
                // tout le monde ne doit pas pouvoir accéder à la liste de l'utilisateur de notre projet.
                // je crée donc un rôle 'user' par défaut, et assignerai un comtpe 'admin' dans le seeder
                // la fonction 'register' sera désactivée, mais conserver cette sécurité me semble pertinent
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
