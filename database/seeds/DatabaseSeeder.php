<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Note::class)->create([
            'text' => 'Welcome to Notes! To create a new note, enter text in the input above, choose a color an click "Add Note".',
            'type' => 'success',
        ]);

        factory(\App\Note::class)->create([
            'text' => 'To edit a note, click the pencil icon in the upper right corner of the note.',
            'type' => 'warning',
        ]);

        factory(\App\Note::class)->create([
            'text' => 'To delete a note, click the little X in the upper right corner of the note',
            'type' => 'danger',
        ]);
    }
}
