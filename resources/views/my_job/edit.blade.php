@php use App\Models\Job; @endphp
<x-layout>
    <x-breadcrumps :links="['My Jobs' => route('my-job.index'), 'Edit' => '#']" class="mb-4"/>

    <x-card class="mb-8">
        <form action="{{ route('my-job.update',$job) }}" method="POST">
            @csrf
            @method("PUT")

            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <label for="title">Job Title</label>
                    <x-text-input name="title" :value="$job->title"/>
                </div>

                <div>
                    <label for="location">Location</label>
                    <x-text-input name="location" :value="$job->location"/>
                </div>

                <div class="col-span-2">
                    <label for="salary">Salary</label>
                    <x-text-input name="salary" type="number" :value="$job->salary"/>
                </div>

                <div class="col-span-2">
                    <label for="description">Description</label>
                    <x-text-input name="description" type="textarea" :value="$job->description"/>
                </div>

                <div>
                    <label for="experience">Experience</label>
                    <x-radio-group name="experience" :value="$job->experience"
                                   :allOption="false"
                                   :options="array_combine(
                                  array_map('ucfirst', Job::$experience),
                                    Job::$experience,
                )"/>
                </div>

                <div>
                    <label for="category">Category</label>
                    <x-radio-group name="category" :all-option="false"  :value="$job->category"
                                   :options="Job::$category"/>
                </div>

                <div class="col-span-2">
                    <button class="w-full">Update Job</button>
                </div>
            </div>
        </form>
    </x-card>
</x-layout>
