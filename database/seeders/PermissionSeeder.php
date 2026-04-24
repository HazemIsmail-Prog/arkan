<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // wanna create permession for actions [viewAll, create, update, delete] for each model

        $models = [
            'User',
            'Role',
            'Permission',
            'Company',
            'Document',
            'Document_Attachments',
            'RequiredApproval',
            'Equipment',
            'Setting',
        ];

        $actions = [
            'view_all' => [
                'en' => 'View all :model',
                'ar' => 'عرض جميع :model',
            ],
            'create' => [
                'en' => 'Create :model',
                'ar' => 'إنشاء :model',
            ],
            'update' => [
                'en' => 'Update :model',
                'ar' => 'تعديل :model',
            ],
            'delete' => [
                'en' => 'Delete :model',
                'ar' => 'حذف :model',
            ],
        ];

        // Simple model name mappings for display in EN/AR
        $modelNames = [
            'User' => [
                'en' => 'User',
                'ar' => 'مستخدم',
            ],
            'Role' => [
                'en' => 'Role',
                'ar' => 'دور',
            ],
            'Permission' => [
                'en' => 'Permission',
                'ar' => 'إذن',
            ],
            'Company' => [
                'en' => 'Company',
                'ar' => 'شركة',
            ],
            'Document' => [
                'en' => 'Document',
                'ar' => 'مستند',
            ],
            'Document_Attachments' => [
                'en' => 'Document Attachments',
                'ar' => 'مرفقات المستندات',
            ],
            'RequiredApproval' => [
                'en' => 'Required Approval',
                'ar' => 'التقرير المطلوب',
            ],
            'Equipment' => [
                'en' => 'Equipment',
                'ar' => 'المعدات',
            ],
            'Setting' => [
                'en' => 'Setting',
                'ar' => 'الإعدادات',
            ],
        ];


        $permissions = [];

        foreach ($models as $model) {
            foreach ($actions as $action => $translations) {
                $permissions[] = [
                    'name' => strtolower($action) . '_' . strtolower($model),
                    'description_en' => str_replace(':model', $modelNames[$model]['en'], $translations['en']),
                    'description_ar' => str_replace(':model', $modelNames[$model]['ar'], $translations['ar']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        Permission::insert($permissions);
    }
}
