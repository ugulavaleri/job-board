<x-layout>
    <x-breadcrumps :links="[ 'My Job Applications' => '#' ]" class="mb-5"/>
    @forelse($applications as $application)
        <x-job-card :job="$application->job">
            <div class="flex items-center justify-between text-xs text-slate-500">
                <div>
                    <div>
                        applied {{ $application->created_at->diffForHumans() }}
                    </div>
                    <div>
                        Your asking salary - ${{ number_format($application->expected_salary) }}
                    </div>
                    <div>
                        average asking salary - {{ $application->job->job_applications_avg_expected_salary  }}
                    </div>
                    <div>
                        other participants - {{ $application->job->job_applications_count }}
                    </div>
                </div>
                <div>
                    <form action="{{ route('my_job_applications.destroy', $application ) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit">Cancel</button>
                    </form>
                </div>
            </div>
        </x-job-card>
    @empty
        <div class="rounded-md border border-dashed border-slate-300 p-8">
            <div class="text-center font-medium">
                No job application yet
            </div>
            <div class="text-center">
                find jobs <a class="text-indigo-500 hover:underline" href="{{ route('jobs.index') }}">here!</a>
            </div>
        </div>
    @endforelse
</x-layout>
