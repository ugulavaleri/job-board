<x-layout>
    <x-breadcrumps :links="[ 'My Job Applications' => '#' ]" class="mb-5"/>
        @forelse($applications as $application)
            <x-job-card :job="$application->job"></x-job-card>
        @empty
            <p>No application applied!</p>
        @endforelse
</x-layout>
