<x-layout>
    <x-breadcrumps :links="['Jobs' => route('jobs.index'), $job->title => '#' ]" class="mb-5"/>
    <x-job-card :$job >
        <p class="text-sm text-slate-500 mb-4">
            {!! nl2br(e($job->description)) !!}
        </p>
        <div>
            @can('apply',$job)
                <button>
                    <a href="{{ route('job.application.create',$job) }}">apply</a>
                </button>
            @else
                <div class="text-center">
                    <p>Already applied to this Job!</p>
                </div>
            @endcan

        </div>
    </x-job-card>
    <x-card class="mb-4">
        <h2 class="mb-4 text-lg font-medium">
            More {{ $job->employee->company_name }} Jobs
        </h2>

        <div class="text-sm text-slate-500">
            @foreach ($job->employee->jobs as $otherJob)
                <div class="mb-4 flex justify-between">
                    <div>
                        <div class="text-slate-700">
                            <a href="{{ route('jobs.show', $otherJob) }}">
                                {{ $otherJob->title }}
                            </a>
                        </div>
                        <div class="text-xs">
                            {{ $otherJob->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <div class="text-xs">
                        ${{ number_format($otherJob->salary) }}
                    </div>
                </div>
            @endforeach
        </div>
    </x-card>
</x-layout>
