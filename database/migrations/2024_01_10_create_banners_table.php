public function up()
{
    Schema::create('banners', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('subtitle')->nullable();
        $table->string('image');
        $table->integer('order')->default(0);
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}