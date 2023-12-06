<x-layout>
    <x-breadcrumps :links="['My Jobs' => '#']" class="mb-4"/>

    <div class="flex justify-end">
        <button>
            <a href="{{ route('my-job.create') }}">
                Add Job
            </a>
        </button>
    </div>
    <x-card>
        @forelse($jobs as $job)
            <x-job-card :$job>
                <div class="text-xs text-slate-500">
                    @forelse($job->jobApplications as $jobApplication)
                        <div class="flex justify-between items-center">
                            <div>
                                <p>{{ $jobApplication->user->name }}</p>
                                <p>Applied {{ $jobApplication->created_at->diffForHumans() }}</p>
                                <p>Download CV</p>
                            </div>
                            <div>
                                expected Salary : ${{ number_format($jobApplication->expected_salary) }}
                            </div>
                        </div>
                    @empty
                        <div>No applications yet!</div>
                        <div>
                            <p>post your first job <a href="{{ route('my-job.create') }}"
                                                      class="text-indigo-500 hover:underline">here</a></p>
                        </div>
                    @endforelse
                </div>
                <div class="mt-3 flex gap-2">
                    <a href="{{ route('my-job.edit', $job) }}">
                        <button class="border border-slate-500 px-4 py-[2px] rounded-[3px]">
                            Edit
                        </button>
                    </a>
                    <form action="{{ route('my-job.destroy',$job) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border border-slate-500 px-4 py-[2px] rounded-[3px]">
                            Delete
                        </button>
                    </form>
                </div>
            </x-job-card>
        @empty
            <h1 class="text-center">
                No Jobs!
            </h1>
        @endforelse
    </x-card>
</x-layout>
