# Add Books Functionality Guide

## Overview
The Add Books functionality allows **admin users** to add new books to the library management system. This feature is restricted to users with the 'admin' role.

## How to Access

### 1. Login as Admin
- Navigate to: `http://127.0.0.1:8000/login`
- Use admin credentials:
  - **Email**: `admin@library.com`
  - **Password**: `password`

### 2. Navigate to Books Management
- From the dashboard, click on **"🔧 Manage Books"** button
- Or directly visit: `http://127.0.0.1:8000/books`

### 3. Click "Add Book" Button
- On the Books page, click the **"➕ Add Book"** button in the header
- This will take you to: `http://127.0.0.1:8000/books/create`

## Features

### Add New Book Form
The form includes the following fields:

1. **Book Title** * (Required)
   - Example: "The Great Gatsby"
   - Maximum 255 characters

2. **Author** * (Required)
   - Example: "F. Scott Fitzgerald"
   - Maximum 255 characters

3. **Category** (Optional)
   - Example: "Fiction", "Science", "History"
   - Maximum 255 characters

4. **Total Copies** * (Required)
   - Number of total copies in the library
   - Minimum: 0
   - Default: 1

5. **Available Copies** * (Required)
   - Number of copies currently available for borrowing
   - Must be less than or equal to Total Copies
   - Minimum: 0
   - Default: 1

### Validation Rules

✅ **Valid Submission:**
- All required fields filled
- Available copies ≤ Total copies
- All numeric fields ≥ 0

❌ **Invalid Submission:**
- Missing required fields
- Available copies > Total copies
- Negative numbers

### Success Flow

1. Fill in the form with valid data
2. Click **"➕ Add Book"** button
3. Redirected to books listing page
4. Green success message: **"✅ Book created successfully!"**
5. New book appears in the books grid

### Cancel Option

- Click **"Cancel"** button to return to books listing without saving

## Technical Details

### Routes
```php
Route::middleware('admin')->group(function () {
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
});
```

### Controller Method
```php
public function store(StoreBookRequest $request)
{
    Book::create($request->validated());
    return redirect()->route('books.index')->with('status', 'Book created successfully!');
}
```

### Form Request Validation
```php
public function rules(): array
{
    return [
        'title'            => ['required', 'string', 'max:255'],
        'author'           => ['required', 'string', 'max:255'],
        'category'         => ['nullable', 'string', 'max:255'],
        'total_copies'     => ['required', 'integer', 'min:0'],
        'available_copies' => ['required', 'integer', 'min:0', 'lte:total_copies'],
    ];
}
```

## User Interface

### For Admin Users
- Header shows: **"Manage Books"** with subtitle "Admin Panel"
- **➕ Add Book** button visible in header
- Each book card shows **✏️ Edit** and **🗑️ Delete** buttons

### For Regular Users
- Header shows: **"Browse Books"**
- No Add/Edit/Delete buttons
- Can only view and borrow books

## Security

- Protected by **AdminMiddleware**
- Only users with `role = 'admin'` can access
- Regular users get **403 Forbidden** error if they try to access directly
- Not logged in users are redirected to login page

## Error Handling

### Common Errors

1. **"Available copies cannot exceed total copies"**
   - Solution: Make sure available copies ≤ total copies

2. **"The book title is required"**
   - Solution: Fill in the title field

3. **"Total copies must be at least 0"**
   - Solution: Use positive numbers only

4. **"Admin access required"** (403 Error)
   - Solution: Login as admin user

## Testing the Feature

### Test Case 1: Add Valid Book
```
Title: "Clean Code"
Author: "Robert C. Martin"
Category: "Programming"
Total Copies: 5
Available Copies: 5
Expected: Success ✅
```

### Test Case 2: Invalid Data
```
Title: "Test Book"
Author: "Test Author"
Category: "Test"
Total Copies: 5
Available Copies: 10
Expected: Error - "Available copies cannot exceed total copies" ❌
```

### Test Case 3: Missing Required Field
```
Title: ""
Author: "Test Author"
Total Copies: 5
Available Copies: 5
Expected: Error - "The book title is required" ❌
```

## Additional Features

### Edit Books
- Click **✏️ Edit** button on any book card
- Update book information
- Uses the same form as Add Book

### Delete Books
- Click **🗑️ Delete** button on any book card
- Deletes the book from the system
- Cannot delete if book has active borrows

## Navigation

All pages show role-aware navigation:
- **Admin**: "← Back to Manage Books"
- **Regular User**: "← Back to Browse Books"
- **Guest**: "← Back to Books"

---

## Quick Start Checklist

- [ ] Start development server: `php artisan serve`
- [ ] Login as admin: `admin@library.com` / `password`
- [ ] Navigate to: `http://127.0.0.1:8000/books`
- [ ] Click: **"➕ Add Book"**
- [ ] Fill in the form
- [ ] Submit and verify success message

✨ **Happy Managing!**
