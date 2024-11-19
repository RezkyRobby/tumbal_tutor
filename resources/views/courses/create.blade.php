<!-- resources/views/courses/create.blade.php -->
<h1>Create New Course</h1>
<form action="{{ route('courses.store') }}" method="POST">
    @csrf
    <label for="course_name">Course Name:</label>
    <input type="text" name="course_name" id="course_name" :value="old('course_name')">
    
    <label for="description">Description:</label>
    <textarea name="description"></textarea>
    
    <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" required>
    
    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" required>
    
    <button type="submit">Create Course</button>
</form>
