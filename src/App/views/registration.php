<?php
include $this->resolve("partials/_header.php");

?>
<section class="max-w-2xl mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">

    <form method="POST" class="grid grid-cols-1 gap-6">
        <!-- Email -->
        <label class="block">
            <span class="text-gray-700">Email address</span>
            <input value="<?php echo e($oldFormData['e-mail'] ?? ''); ?>" name="e-mail" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="john@example.com" />
            <?php
            if (array_key_exists('e-mail', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500"><?php echo e($errors['e-mail'][0]) ?></div>
            <?php endif; ?>
        </label>
        <!-- Age -->
        <label class="block">
            <span class="text-gray-700">Age</span>
            <input value="<?php echo e($oldFormData['Age'] ?? ''); ?>" name="Age" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" />
            <?php
            if (array_key_exists('Age', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500"><?php echo e($errors['Age'][0]) ?></div>
            <?php endif; ?>
        </label>
        <!-- Country -->
        <label class="block">
            <span class="text-gray-700">Country</span>
            <select name="Country" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="USA">USA</option>
                <option value="Canada" <?php echo $oldFormData['Country'] === 'Canada' ? 'selected' : ''; ?>>Canada</option>
                <option value="Mexico" <?php echo $oldFormData['Country'] === 'Mexico' ? 'selected' : ''; ?>>Mexico</option>
                <option value="Invalid">Invalid Country</option>
            </select>
            <?php
            if (array_key_exists('Country', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500"><?php echo e($errors['Country'][0]) ?></div>
            <?php endif; ?>
        </label>
        <!-- Social Media URL -->
        <label class="block">
            <span class="text-gray-700">Social Media URL</span>
            <input value="<?php echo e($oldFormData['SocialMediaURL'] ?? ''); ?>" name="SocialMediaURL" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" />
            <?php
            if (array_key_exists('SocialMediaURL', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500"><?php echo e($errors['SocialMediaURL'][0]) ?></div>
            <?php endif; ?>
        </label>
        <!-- Password -->
        <label class="block">
            <span class="text-gray-700">Password</span>
            <input name="pwd" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" />
            <?php
            if (array_key_exists('pwd', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500"><?php echo e($errors['pwd'][0]) ?></div>
            <?php endif; ?>
        </label>
        <!-- Confirm Password -->
        <label class="block">
            <span class="text-gray-700">Confirm Password</span>
            <input name="conf_pwd" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" />
            <?php
            if (array_key_exists('conf_pwd', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500"><?php echo e($errors['conf_pwd'][0]) ?></div>
            <?php endif; ?>
        </label>
        <!-- Terms of Service -->
        <div class="block">
            <div class="mt-2">
                <div>
                    <label class="inline-flex items-center">
                        <input <?php echo $oldFormData['tos'] ?? false ? 'checked' : ''; ?> name="tos" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50" type="checkbox" />
                        <span class="ml-2">I accept the terms of service.</span>
                        <?php
                        if (array_key_exists('tos', $errors)) : ?>
                            <div class="bg-gray-100 mt-2 p-2 text-red-500"><?php echo e($errors['tos'][0]) ?></div>
                        <?php endif; ?>
                    </label>
                </div>
            </div>
        </div>
        <button type="submit" class="block w-full py-2 bg-indigo-600 text-white rounded">
            Submit
        </button>
    </form>
</section>
<?php
include $this->resolve("partials/_footer.php");

dd($oldFormData); ?>