<div>
    @foreach($sections as $section)
        @include("sections.{$section->section_key}", ['section' => $section])
    @endforeach
</div>
