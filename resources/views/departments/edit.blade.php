@extends('layouts.admin')

@section('title', 'Add Department')

@section('content')

<style>
    .department-form-wrap {
        max-width: 600px;
        margin: 0 auto;
    }

    .department-form-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
        border: 1px solid #eef0f4;
        overflow: hidden;
    }

    .department-form-header {
        padding: 22px 24px;
        border-bottom: 1px solid #eef0f4;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    }

    .department-form-header h2 {
        color: #fff;
        font-size: 19px;
        font-weight: 700;
        margin: 0;
    }

    .department-form-header p {
        color: rgba(255, 255, 255, 0.85);
        font-size: 13px;
        margin: 4px 0 0;
    }

    .department-form-body {
        padding: 26px;
    }

    .field {
        margin-bottom: 20px;
    }

    .field label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 7px;
    }

    .field .req {
        color: #ef4444;
    }

    .field .form-control,
    .field select,
    .field textarea {
        width: 100%;
        padding: 11px 14px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        color: #111827;
        background: #fff;
        font-family: inherit;
        box-sizing: border-box;
    }

    .field textarea {
        resize: vertical;
        min-height: 90px;
    }

    .field .form-control:focus,
    .field select:focus,
    .field textarea:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
    }

    .field .text-danger {
        display: block;
        color: #ef4444;
        font-size: 12.5px;
        margin-top: 6px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 8px;
    }

    .btn-cancel {
        padding: 11px 22px;
        background: #f3f4f6;
        color: #374151;
        border: none;
        border-radius: 8px;
        font-size: 14.5px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-cancel:hover {
        background: #e5e7eb;
    }

    .btn-submit {
        padding: 11px 26px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 14.5px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-submit:hover {
        opacity: 0.92;
    }
</style>

<main class="content">

<!-- ========== PAGE TITLE ========== -->
<div class="page-title">

    <div>
        <h1>Add Department</h1>
        <p>Create a new hospital department.</p>
    </div>

</div>


<!-- ========== FORM ========== -->
<div class="department-form-wrap">

    <div class="department-form-card">


        <!-- ========== HEADER ========== -->
        <div class="department-form-header">

            <h2>New Department</h2>

            <p>Fill in the details below to create a new department.</p>

        </div>


        <!-- ========== BODY ========== -->
        <div class="department-form-body">

            <form
                action="{{ route('departments.update', $department->id) }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                <!-- NAME -->
                <div class="field">

                    <label for="name">
                        Department Name <span class="req">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $department->name) }}"
                        placeholder="e.g. Cardiology"
                    >

                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>


                <!-- CODE -->
                <div class="field">

                    <label for="code">
                        Department Code <span class="req">*</span>
                    </label>

                    <input
                        type="text"
                        id="code"
                        name="code"
                        class="form-control"
                        value="{{ old('code', $department->code) }}"
                        placeholder="e.g. CARD01"
                    >

                    @error('code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>


                <!-- DESCRIPTION -->
                <div class="field">

                    <label for="description">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        placeholder="Brief description of this department"
                    >{{ old('description', $department->description) }}</textarea>

                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>


                <!-- STATUS -->
                <div class="field">

                    <label for="status">
                        Status <span class="req">*</span>
                    </label>

                    <select id="status" name="status">

                        <option value="active"
                            {{ old('status', 'active' , $department->status) == 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="inactive"
                            {{ old('status',  $department->status) == 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>


                <!-- ACTIONS -->
                <div class="form-actions">

                    <a
                        href="{{ route('departments.index') }}"
                        class="btn-cancel"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn-submit"
                    >
                        <i class="fas fa-save"></i>
                        Update Department
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</main>

@endsection
