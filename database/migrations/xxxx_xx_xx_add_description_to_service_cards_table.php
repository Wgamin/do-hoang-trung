public function up()
{
    Schema::table('service_cards', function (Blueprint $table) {
        $table->text('description')->nullable()->after('price');
    });
}

public function down()
{
    Schema::table('service_cards', function (Blueprint $table) {
        $table->dropColumn('description');
    });
}