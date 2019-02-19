<?php

namespace Tests;

use App\Note;
use Illuminate\Support\Collection;
use Laravel\Lumen\Testing\DatabaseMigrations;

class NotesFeatureTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_note_can_be_created_via_REST()
    {
        $data = factory(Note::class)->make()->toArray();

        $this->post('/notes', $data)->assertResponseStatus(201);

        $this->seeInDatabase('notes', $data);
    }

    /** @test */
    public function a_note_can_be_updated_via_rest()
    {
        $oldData = ['text' => 'old text'];
        $updatedData = ['text' => 'updated text'];

        $note = factory(Note::class)->create($oldData);

        $this->put('/notes/' . $note->id, $updatedData)->assertResponseOk();

        $this->notSeeInDatabase('notes', $oldData);
        $this->seeInDatabase('notes', $updatedData);
    }

    /** @test */
    public function a_note_can_be_deleted_via_rest()
    {
        /** @var Note $note */
        $note = factory(Note::class)->create();

        // just because I'm paranoid ;)
        $this->seeInDatabase('notes', ['text' => $note->text]);

        $this->delete('/notes/' . $note->id)->assertResponseOk();

        $this->notSeeInDatabase('notes', ['text' => $note->text]);
    }

    /** @test */
    public function all_notes_can_be_retrieved_via_rest()
    {
        /** @var Collection $notes */
        $notes = factory(Note::class, 10)->create();

        $this->get('/notes')->assertResponseOk();

        $notes->each(function($note) {
            /** @var Note $note */
            $this->seeJsonContains($note->toArray());
        });
    }

    /** @test */
    public function a_note_can_be_retrieved_by_id_via_rest()
    {
        $theNote = factory(Note::class)->create();

        // add some more notes to verify that we are fetching the right one
        factory(Note::class, 10)->create();

        $this->get('/notes/' . $theNote->id)->assertResponseOk();

        $this->seeJsonEquals($theNote->toArray());
    }
}
