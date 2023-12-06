<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public static array $experience = ['entry','intermediate','senior'];
    public static array $category = ['IT','Finance','Sales', 'Marketing'];

    public function employee(){
        return $this->belongsTo(Employee::class,);
    }
    public function jobApplications(){
        return $this->hasMany(JobApplication::class);
    }

    public function hasUserApplied(User $user){
        return $this->where('id', $this->id)
            ->whereHas('jobApplications', fn($query) =>
                $query->where('user_id', $user->id)
            )->exists();
    }

    public function scopeFilter($query,$filters){
        return $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhereHas('employee', function($query) use($search) {
                        $query->where('company_name' ,'like', '%' . $search . '%');
                    });
            });
        })->when($filters['min_salary'] ?? null, function ($query, $minSalary) {
            $query->where('salary', '>=', $minSalary);
        })->when($filters['max_salary'] ?? null, function ($query, $maxSalary) {
            $query->where('salary', '<=', $maxSalary);
        })->when($filters['experience'] ?? null, function ($query, $experience) {
            $query->where('experience', $experience);
        })->when($filters['category'] ?? null, function ($query, $category) {
            $query->where('category', $category);
        });

    }

}
