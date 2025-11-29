<?php

namespace App\Services\Admin;

use App\Models\Doctor;
use Illuminate\Support\Facades\DB;

class DoctorService
{
    public function getAllPaginated($perPage = 10)
    {
        return Doctor::latest()->paginate($perPage);
    }

    public function getDashboardCards()
    {
        $total = Doctor::count();
        $active = Doctor::where('status', 'active')->count();
        $inactive = Doctor::where('status', 'inactive')->count();
        $specializations = Doctor::pluck('specialization')->unique()->count();

        return [
            [
                'icon' => 'bi-person-lines-fill',
                'title' => 'Total Doctors',
                'value' => $total,
                'color' => 'text-primary'
            ],
            [
                'icon' => 'bi-person-check',
                'title' => 'Active',
                'value' => $active,
                'color' => 'text-success'
            ],
            [
                'icon' => 'bi-person-x',
                'title' => 'Inactive',
                'value' => $inactive,
                'color' => 'text-danger'
            ],
            [
                'icon' => 'bi-star',
                'title' => 'Specializations',
                'value' => $specializations,
                'color' => 'text-warning'
            ],
        ];
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['profile_image'] = $this->handleProfileImage($data['profile_image'] ?? null);
            return Doctor::create($data);
        });
    }

    public function update(Doctor $doctor, array $data)
    {
        return DB::transaction(function () use ($doctor, $data) {
            if (isset($data['profile_image'])) {
                $data['profile_image'] = $this->handleProfileImage($data['profile_image'], $doctor->profile_image);
            }
            $doctor->update($data);
            return $doctor;
        });
    }

    public function toggleStatus(Doctor $doctor)
    {
        $doctor->status = $doctor->status === 'active' ? 'inactive' : 'active';
        $doctor->save();
        return $doctor;
    }

    private function handleProfileImage($file, $oldImage = null)
    {
        if (!$file) return $oldImage;

        if ($oldImage && file_exists(public_path($oldImage))) {
            unlink(public_path($oldImage));
        }

        $imageName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images/doctors'), $imageName);

        return 'images/doctors/' . $imageName;
    }
}
